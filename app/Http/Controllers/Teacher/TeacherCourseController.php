<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class TeacherCourseController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->load('teacherCourses.course');
        return view('teacher.courses', ['courses' => $courses]);
    }
}
