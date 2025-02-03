<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CourseAssignmentService;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.viewCourses', ['courses' => $courses]);
    }

    public function create()
    {
        return view('admin.addCourse');
    }

    public function store(Request $request)
    {

        $course = Course::create([
            'title' => $request->title,
            'code' => $request->code,
            'credit' => $request->credit,
        ]);

        $teacher = User::find($request->teacher_id);

        $teacher->courses()->attach($course->id);

        return redirect('/courses')->with('success', 'Course added successfully.');

    }

    public function edit(Course $course)
    {

        $courseAssignment = new CourseAssignmentService();
        $data['course'] = $course;
        $data['user_id'] = $courseAssignment->getUserByCourseId($course->id)?->user_id;

        return view('admin.editCourse', $data);
    }

    public function update(Course $course, Request $request)
    {

        $course->update([
            'title' => $request->title,
            'code' => $request->code,
            'credit' => $request->credit
        ]);

        $course->users()->sync([$request->teacher_id]);

        return redirect('/courses')->with('success', 'Course updated successfully.');

    }

    public function destroy(Course $course)
    {

        $course->users()->detach();
        $course->delete();

        return redirect('/courses')->with('success', 'Course deleted successfully.');
    }

}
