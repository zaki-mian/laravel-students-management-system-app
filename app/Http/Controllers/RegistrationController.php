<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use App\Models\Student;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = Registration::with('student', 'course')->get();
        return view('admin.registration.index', ['registrations' => $registrations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::with('user')->get();
        $courses = Course::all();
        return view('admin.registration.create', ['students' => $students, 'courses' => $courses]);
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
            'student' => ['required', 'unique:registrations,student_id,' . $request->student . ',id,course_id,'.$request->course],
            'course' => ['required'],
        ],[
            'student.unique' => 'This student is already registered with the selected course'
        ]);

        // $is_already_registered = Registration::where([
        //     ['course_id', '=', $request->course],
        //     ['student_id', '=', $request->student]
        // ])->get();

        // if (count($is_already_registered) == 0) {
            $data = [
                'student_id' => $request->student,
                'course_id' => $request->course
            ];

            $is_registration_created = Registration::create($data);

            if ($is_registration_created) {
                return back()->with('success', 'Magic has been spelled');
            } else {
                return back()->with('failed', 'Magic has failed to spell');
            }
        // } else {
        //     return back()->with('failed', 'Aleady Registered');
        // }
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
    public function edit(Registration $registration)
    {
        $students = Student::with('user')->get();
        $courses = Course::all();
        return view('admin.registration.edit', ['students' => $students, 'courses' => $courses, 'registration' => $registration]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        $request->validate([
            'student' => ['required', 'unique:registrations,student_id,' . $registration->id . ',id,course_id,' . $request->course],
            'course' => ['required'],
        ],[
            'student.unique' => 'This student is already registered with the selected course'
        ]);

        // $is_already_registered = Registration::where([
        //     ['course_id', '=', $request->course],
        //     ['student_id', '=', $request->student],
        //     ['id', '!=', $registration->id]
        // ])->get();

        // if (count($is_already_registered) == 0) {
            $data = [
                'student_id' => $request->student,
                'course_id' => $request->course
            ];

            $is_registration_updated = Registration::find($registration->id)->update($data);

            if ($is_registration_updated) {
                return back()->with('success', 'Magic has been spelled');
            } else {
                return back()->with('failed', 'Magic has failed to spell');
            }
        // } else {
        //     return back()->with('failed', 'Aleady Registered');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        $is_registration_deleted = Registration::find($registration->id)->delete();

        if ($is_registration_deleted) {
            return back()->with('success', 'Magic has been spelled');
        } else {
            return back()->with('failed', 'Magic has failed to spell');
        }
    }
}
