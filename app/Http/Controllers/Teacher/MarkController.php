<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Mark;
use Illuminate\Http\Request;
use App\Services\ExcelService;
use App\Http\Controllers\Controller;
use App\Services\CourseAssignmentService;

class MarkController extends Controller
{
    public function index()
    {
        $marks = Mark::with('course')->select('id', 'course_id', 'registration_no', 'final_sessional_marks', 'mid_term_marks', 'created_at')->get();
        return view('teacher.viewMarks', ['marks' => $marks]);
    }

    public function create()
    {
        $courseAssignmentService = new CourseAssignmentService();
        $data['assignedCourses'] = $courseAssignmentService->getAssignedCourses();
        return view('teacher.uploadMarks', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'marks_file' => 'required|file|mimes:xlsx,xls'
        ]);

        $course_id = $request->course_id;

        $marks_file = $request->file('marks_file');

        $marksData = ExcelService::readAndProcessMarksFile($course_id, $marks_file);

        try {
            Mark::insert($marksData);
            $responseData = ['status' => 'success', 'message' => 'Marks Upload Successfully.'];

        } catch (Exception $e) {
            $responseData = ['status' => 'error', 'message' => 'Failed To Upload Marks.'];
        }

        return redirect('marks/upload')->with($responseData['status'], $responseData['message']);
    }
}
