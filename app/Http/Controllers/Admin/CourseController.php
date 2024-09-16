<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    
    public function index() {
        $courses = Course::all();
        return view('admin.viewCourses', ['courses' => $courses]);
    }

    public function create() {
        return view('admin.addCourse');
    }

    public function store(Request $request) {
        
        Course::create([
            'title' => $request->title,
            'code' => $request->code,
            'credit' => $request->credit,
        ]);

        return redirect('/courses')->with('success', 'Course added successfully.');

    }

    public function edit(Course $course) {
        return view('admin.editCourse', ['course' => $course]);
    }

    public function update(Course $course, Request $request) {

        $course->update([
            'title' => $request->title,
            'code' => $request->code, 
            'credit' => $request->credit
        ]);

        return redirect('/courses')->with('success', 'Course updated successfully.');

    }

    public function destroy(Course $course) {

        $course->delete();
        return redirect('/courses')->with('success', 'Course deleted successfully.');
    }

}
