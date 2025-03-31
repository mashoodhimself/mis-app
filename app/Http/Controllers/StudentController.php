<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Result;
use App\Models\Attendance;
use App\Actions\CreateMarks;
use Illuminate\Http\Request;
use App\Actions\CreateResult;
use App\Services\ExcelService;
use App\Actions\CreateAttendance;
use App\Http\Requests\StoreMarksRequest;
use App\Http\Requests\StoreResultRequest;
use App\Services\CourseAssignmentService;
use App\Http\Requests\StoreAttendanceRequest;

class StudentController extends Controller
{

    private $courseAssignmentService;

    public function __construct()
    {
        $this->courseAssignmentService = new CourseAssignmentService();
    }

    public function attendanceIndex(Request $request)
    {

        $data = [];

        if ($request->method() === 'POST') {
            $course_id = $request->course;
            $results = Attendance::with('course')->select('id', 'course_id', 'registration_no', 'student_name', 'semester', 'section', 'attendance', 'attendance_date')->where('course_id', $course_id)->get();
            $data['course_id'] = (int) $course_id;
            $data['attendanceRecords'] = $results;
            $data['courses'] = $this->courseAssignmentService->getThisTeacherCoursesHavingAttendance(auth()->user()->id);

        } else {
            $results = Attendance::with('course')->select('id', 'course_id', 'registration_no', 'student_name', 'semester', 'section', 'attendance', 'attendance_date')->get();
            $data['attendanceRecords'] = $results;
            $data['courses'] = $this->courseAssignmentService->getThisTeacherCoursesHavingAttendance(auth()->user()->id);
        }

        return view('teacher.viewAttendance', $data);
    }

    public function adminAttendanceIndex(Request $request)
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

    public function attendanceCreate()
    {
        $data['assignedCourses'] = $this->courseAssignmentService->getThisTeacherAssignedCourses();
        return view('teacher.uploadAttendance', $data);
    }

    public function attendanceStore(StoreAttendanceRequest $request)
    {
        $validatedData = $request->validated();
        $responseData = CreateAttendance::handle($validatedData);
        return redirect('attendance/upload')->with($responseData['status'], $responseData['message']);
    }

    public function attendanceEdit(Attendance $attendance)
    {
        return view('teacher.editAttendance', ['attendanceRecord' => $attendance]);
    }

    public function attendanceUpdate(Attendance $attendance, Request $request)
    {
        $attendance->update(['attendance' => $request->attendance]);
        return redirect('/attendance/edit/' . $attendance->id)->with('success', 'Attendance Updated successfully.');
    }

    public function attendanceDestroy(Request $request)
    {
        $course_id = (int) $request->courseId;
        $deleted = Attendance::where('course_id', $course_id)->delete();
        return response()->json([ 'message' => $deleted ? 'Records deleted successfully' : 'Something went wrong pls try again!' ], $deleted ? 200 : 400);
    }

    public function marksIndex(Request $request)
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

    public function marksCreate()
    {
        $courseAssignmentService = new CourseAssignmentService();
        $data['assignedCourses'] = $courseAssignmentService->getThisTeacherAssignedCourses();
        return view('teacher.uploadMarks', $data);
    }

    public function marksStore(StoreMarksRequest $request)
    {
        $validatedData = $request->validated();
        $responseData = CreateMarks::handle($validatedData);
        return redirect('marks/upload')->with($responseData['status'], $responseData['message']);
    }

    public function marksDestroy(Request $request)
    {
        $course_id = (int) $request->courseId;
        $deleted = Mark::where('course_id', $course_id)->delete();
        return response()->json([ 'message' => $deleted ? 'Records deleted successfully' : 'Something went wrong pls try again!' ], $deleted ? 200 : 400);
    }

    public function resultIndex(Request $request)
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

    public function resultCreate()
    {
        $data['assignedCourses'] = $this->courseAssignmentService->getThisTeacherAssignedCourses();
        return view('teacher.uploadResults', $data);
    }

    public function resultStore(StoreResultRequest $request)
    {
        $validatedData = $request->validated();
        $responseData = CreateResult::handle($validatedData);
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

    public function resultDestroy(Request $request)
    {
        $course_id = (int) $request->courseId;
        $deleted = Result::where('course_id', $course_id)->delete();
        return response()->json([ 'message' => $deleted ? 'Records deleted successfully' : 'Something went wrong pls try again!' ], $deleted ? 200 : 400);
    }


}
