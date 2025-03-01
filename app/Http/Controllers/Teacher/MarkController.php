<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Mark;
use Illuminate\Http\Request;
use App\Services\ExcelService;
use App\Http\Controllers\Controller;
use App\Services\CourseAssignmentService;

class MarkController extends Controller
{
    public function __construct(private $courseAssignmentService = new CourseAssignmentService())
    {

    }

    public function index(Request $request)
    {

        $data = [];

        if ($request->method() === 'POST') {
            $course_id = $request->course;
            $results = Mark::with('course')->select('id', 'course_id', 'registration_no', 'final_sessional_marks', 'mid_term_marks', 'created_at')->where('course_id', $course_id)->get();
            $data['course_id'] = (int) $course_id;
            $data['marks'] = $results;
            $data['courses'] = $this->courseAssignmentService->getThisTeacherCoursesHavingMarks(auth()->user()->id);

        } else {
            $results = Mark::with('course')->select('id', 'course_id', 'registration_no', 'final_sessional_marks', 'mid_term_marks', 'created_at')->get();
            $data['marks'] = $results;
            $data['courses'] = $this->courseAssignmentService->getThisTeacherCoursesHavingMarks(auth()->user()->id);
        }

        return view('teacher.viewMarks', $data);
    }

    public function create()
    {
        $courseAssignmentService = new CourseAssignmentService();
        $data['assignedCourses'] = $courseAssignmentService->getThisTeacherAssignedCourses();
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

    public function destroy(Request $request)
    {

        $course_id = (int) $request->courseId;
        $deleted = Mark::where('course_id', $course_id)->delete();
        return response()->json([ 'message' => $deleted ? 'Records deleted successfully' : 'Something went wrong pls try again!' ], $deleted ? 200 : 400);
    }

}
