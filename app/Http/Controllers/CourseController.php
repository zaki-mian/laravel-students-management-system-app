<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.courses.index', ['courses' => Course::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
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
            'name' => ['required', 'unique:courses,name']
        ]);
        $is_course_created = Course::create([
            'name' => $request->name
        ]);
        if($is_course_created) {
            return back()->with('success', 'Magic has been spelled');
        } else {
            return back()->with('failed', 'Magic has failed to spell');
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
    public function edit(Course $course)
    {
        return view('admin.courses.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => ['required', 'unique:courses,name,' . $course->id . ',id']
        ]);
        $is_course_updated = Course::find($course->id)->update([
            'name' => $request->name
        ]);

        if($is_course_updated) {
            return back()->with('success', 'Magic has been spelled');
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
    public function destroy(Course $course)
    {
        $is_course_deleted = Course::find($course->id)->delete();

        if($is_course_deleted) {
            return back()->with('success', 'Magic has been spelled');
        } else {
            return back()->with('failed', 'Magic has failed to spell');
        }
    }
}
