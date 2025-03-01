<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Services\ExcelService;
use App\Http\Controllers\Controller;
use App\Services\CourseAssignmentService;

class ResultController extends Controller
{
    public function __construct(private $courseAssignmentService = new CourseAssignmentService())
    {

    }

    public function index(Request $request)
    {

        $data = [];

        if ($request->method() === 'POST') {
            $course_id = $request->course;
            $results = Result::with('course')->select('id', 'course_id', 'registration_no', 'sessional_marks', 'midterm_marks', 'final_marks', 'final_score', 'normalized_score', 'grade', 'gpa', 'created_at')->where('course_id', $course_id)->get();
            $data['course_id'] = (int) $course_id;
            $data['results'] = $results;
            $data['courses'] = $this->courseAssignmentService->getThisTeacherCoursesHavingResults(auth()->user()->id);

        } else {
            $results = Result::with('course')->select('id', 'course_id', 'registration_no', 'sessional_marks', 'midterm_marks', 'final_marks', 'final_score', 'normalized_score', 'grade', 'gpa', 'created_at')->get();
            $data['results'] = $results;
            $data['courses'] = $this->courseAssignmentService->getThisTeacherCoursesHavingResults(auth()->user()->id);
        }

        return view('teacher.viewResults', $data);
    }

    public function create()
    {
        $data['assignedCourses'] = $this->courseAssignmentService->getThisTeacherAssignedCourses();
        return view('teacher.uploadResults', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'results_file' => 'required|file|mimes:xlsx,xls'
        ]);

        $course_id = $request->course_id;

        $results_file = $request->file('results_file');

        $resultsData = ExcelService::readAndProcessResultsFile($course_id, $results_file);

        try {
            Result::insert($resultsData);
            $responseData = ['status' => 'success', 'message' => 'Results Upload Successfully.'];

        } catch (Exception $e) {
            $responseData = ['status' => 'error', 'message' => 'Failed To Upload Results.'];
        }

        return redirect('results/upload')->with($responseData['status'], $responseData['message']);
    }

    public function gradeDistributionGraph()
    {
        $data['courses'] = $this->courseAssignmentService->getThisTeacherCoursesHavingResults(auth()->user()->id);
        return view('teacher.gradeDistributionGraph', $data);
    }

    public function getGradeCountByCourseId()
    {
        $result = new Result();

        $gradesLabel = ['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'F'];

        $gradesCountValues = [
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[0]),
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[1]),
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[2]),
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[3]),
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[4]),
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[5]),
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[6]),
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[7]),
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[8]),
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[9]),
            $result->getThisGradeCountByCourse(request()->course_id, $gradesLabel[10]),
        ];

        echo json_encode([
            'labels' => $gradesLabel,
            'values' => $gradesCountValues
        ]);
        
    }

    public function destroy(Request $request)
    {

        $course_id = (int) $request->courseId;
        $deleted = Result::where('course_id', $course_id)->delete();
        return response()->json([ 'message' => $deleted ? 'Records deleted successfully' : 'Something went wrong pls try again!' ], $deleted ? 200 : 400);
    }
}
