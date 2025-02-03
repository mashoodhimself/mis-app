<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CourseAssignmentService;

class StudentController extends Controller
{
    public function attendanceIndex(Request $request)
    {
        $courseAssignmentService = new CourseAssignmentService();
        $data['assignedCourses'] = $courseAssignmentService->getAssignedCourses();

        if($request->method() === 'POST') {
            $attendanceModel = new Attendance();
            $attendanceByCourse = $attendanceModel->select('id', 'registration_no', 'student_name', 'semester', 'section', 'attendance', 'attendance_date')->where('course_id', $request->course_id)->get();
            $data['course_id'] = (int) $request->course_id;
            $data['attendance'] = $attendanceByCourse;
        } 

        return view('admin.studentAttendance', $data);
    }



}
