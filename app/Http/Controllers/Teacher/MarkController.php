<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CourseAssignmentService;

class MarkController extends Controller
{
    public function create()
    {
        $courseAssignmentService = new CourseAssignmentService();
        $data['assignedCourses'] = $courseAssignmentService->getAssignedCourses();
        return view('teacher.uploadMarks', $data);
    }
}
