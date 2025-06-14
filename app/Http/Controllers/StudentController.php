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

    public function attendanceIndex($course_id)
    {
        $data = [];
        $results = Attendance::with('course')->select('id', 'course_id', 'registration_no', 'student_name', 'semester', 'section', 'attendance', 'attendance_date')->where('course_id', $course_id)->get();
        $data['course_id'] = (int) $course_id;
        $data['attendanceRecords'] = $results;
        $data['courses'] = $this->courseAssignmentService->getThisTeacherCoursesHavingAttendance(auth()->user()->id);

        return view('teacher.viewAttendance', $data);
    }

    public function adminAttendanceIndex(Request $request)
    {
        $courseAssignmentService = new CourseAssignmentService();
        $data['assignedCourses'] = $courseAssignmentService->getAssignedCourses();

        if($request->method() === 'POST') {
            $attendanceModel = new Attendance();
            $attendanceByCourse = $attendanceModel->select('id', 'registration_no', 'student_name', 'semester', 'section', 'attendance', 'attendance_date')
                                                ->where('course_id', $request->course_id)
                                                ->when($request->attendance_date, function($query, $date) {
                                                    return $query->where('attendance_date', $date);
                                                })->get();
            $data['course_id'] = (int) $request->course_id;
            $data['attendance'] = $attendanceByCourse;
        } 

        return view('admin.studentAttendance', $data);
    }

    public function adminMarksIndex(Request $request)
    {
        $courseAssignmentService = new CourseAssignmentService();
        $data['assignedCourses'] = $courseAssignmentService->getAssignedCourses();

        if($request->method() === 'POST') {
            $marksModel = new Mark();
            $marksByCourse = $marksModel->select('id', 'registration_no', 'student_name', 'semester', 'section', 'attendance', 'attendance_date')->where('course_id', $request->course_id)->get();
            $data['course_id'] = (int) $request->course_id;
            $data['marks'] = $marksByCourse;
        } 

        return view('admin.studentMarks', $data);
    }

    public function attendanceCreate($course_id)
    {
        $data['course_id'] = $course_id;
        return view('teacher.uploadAttendance', $data);
    }

    public function attendanceStore(StoreAttendanceRequest $request)
    {
        $validatedData = $request->validated();
        $responseData = CreateAttendance::handle($validatedData);
        return redirect('teacher/course')->with($responseData['status'], $responseData['message']);
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

    public function marksIndex($course_id)
    {
        $data = [];

        $results = Mark::with('course')->select('id', 'course_id', 'registration_no', 'final_sessional_marks', 'mid_term_marks', 'created_at')->where('course_id', $course_id)->get();
        $data['course_id'] = (int) $course_id;
        $data['marks'] = $results;
        $data['courses'] = $this->courseAssignmentService->getThisTeacherCoursesHavingMarks(auth()->user()->id);

        return view('teacher.viewMarks', $data);
    }

    public function marksCreate($course_id)
    {
        $data['course_id'] = $course_id;
        return view('teacher.uploadMarks', $data);
    }

    public function marksStore(StoreMarksRequest $request)
    {
        $validatedData = $request->validated();
        $responseData = CreateMarks::handle($validatedData);
        return redirect('teacher/course')->with($responseData['status'], $responseData['message']);
    }

    public function marksDestroy(Request $request)
    {
        $course_id = (int) $request->courseId;
        $deleted = Mark::where('course_id', $course_id)->delete();
        return response()->json([ 'message' => $deleted ? 'Records deleted successfully' : 'Something went wrong pls try again!' ], $deleted ? 200 : 400);
    }

    public function resultIndex($course_id)
    {

        $data = [];

        $results = Result::with('course')->select('id', 'course_id', 'registration_no', 'sessional_marks', 'midterm_marks', 'final_marks', 'final_score', 'normalized_score', 'grade', 'gpa', 'created_at')->where('course_id', $course_id)->get();
        $data['course_id'] = (int) $course_id;
        $data['results'] = $results;
        $data['courses'] = $this->courseAssignmentService->getThisTeacherCoursesHavingResults(auth()->user()->id);


        return view('teacher.viewResults', $data);
    }

    public function resultCreate($course_id)
    {
        $data['course_id'] = $course_id;
        return view('teacher.uploadResults', $data);
    }

    public function resultStore(StoreResultRequest $request)
    {
        $validatedData = $request->validated();
        $responseData = CreateResult::handle($validatedData);
        return redirect('teacher/course')->with($responseData['status'], $responseData['message']);
    }

    public function gradeDistributionGraph($course_id)
    {
        $data['course_id'] = $course_id;
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
