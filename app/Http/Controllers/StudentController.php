<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('user')->get();
        return view('admin.students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'profile_picture' => ['required', 'mimes:png,jpg,jpeg']
        ]);
        $file = $request->file('profile_picture');
        $file_name = "p-" . microtime(true) . "." . $file->extension();
        $is_user_created = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345'),
            'profile_picture' => $file_name,
            'user_type' => 'Student'

        ]);

        if ($is_user_created) {
            $is_file_uploaded = $file->move(public_path('uploads'), $file_name);
            if ($is_file_uploaded) {
                $is_student_created = Student::create([
                    'user_id' => $is_user_created->id
                ]);
                if ($is_student_created) {
                    return back()->with('success', 'Magic has been spelled');
                } else {
                    return back()->with('failed', 'Magic has failed to spell');
                }
            } else {
                return back()->with('failed', 'File has failed to upload');
            }
        } else {
            return back()->with('failed', 'User has failed to add');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('admin.students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $student->user_id . ',id'],
            'profile_picture' => ['mimes:png,jpg,jpeg']
        ]);

        $file = $request->file('profile_picture');
        $file_name = '';
        $old_file_name = '';

        if ($file) {
            $file_name = "p-" . microtime(true) . "." . $file->extension();
            $old_file_name = $student->user->profile_picture;
        } else {
            $file_name = $student->user->profile_picture;
        }

        $is_user_updated = User::find($student->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile_picture' => $file_name
        ]);

        if ($is_user_updated) {
            if ($file) {
                File::delete(public_path('uploads/' . $old_file_name));
                $is_file_uploaded = $file->move(public_path('uploads'), $file_name);
                if ($is_file_uploaded) {
                    return back()->with('success', 'Magic has been spelled');
                } else {
                    return back()->with('failed', 'Magic has failed to spell');
                }
            } else {
                return back()->with('success', 'Magic has been spelled');
            }
        } else {
            return back()->with('failed', 'Magic has failed to spell');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $is_file_deleted = File::delete(public_path('uploads/' . $student->user->profile_picture));
        
        if ($is_file_deleted) {
            $is_user_deleted = User::find($student->user_id)->delete();
            if ($is_user_deleted) {
                return back()->with('success', 'Magic has been spelled');
            } else {
                return back()->with('failed', 'Magic has failed to spell');
            }
        } else {
            return back()->with('failed', 'Magic has failed to spell');
        }
    }
}
