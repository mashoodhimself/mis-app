<?php

namespace App\Http\Controllers\Teacher;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Services\ExcelService;
use App\Models\TeacherAttendance;
use App\Http\Controllers\Controller;
use App\Services\CourseAssignmentService;

class AttendanceController extends Controller
{
    public function __construct(private $courseAssignmentService = new CourseAssignmentService())
    {

    }

    public function index(Request $request)
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

    public function create()
    {
        $data['assignedCourses'] = $this->courseAssignmentService->getThisTeacherAssignedCourses();
        return view('teacher.uploadAttendance', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'course_id' => 'required',
            'attendance_date' => 'required',
            'attendance_file' => 'required|file|mimes:xlsx,xls'
        ]);

        $course_id = $request->course_id;

        $attendance_date = $request->attendance_date;

        $attendance_file = $request->file('attendance_file');

        try {
            $attendanceData = ExcelService::readAndProcessAttendanceFile($course_id, $attendance_file, $attendance_date);
            Attendance::insert($attendanceData);
            $responseData = ['status' => 'success', 'message' => 'Attendance Upload Successfully.'];

        } catch (Exception $e) {
            $responseData = ['status' => 'error', 'message' => 'Failed To Upload Attendance.'];
        }

        return redirect('attendance/upload')->with($responseData['status'], $responseData['message']);

    }

    public function edit(Attendance $attendance)
    {
        return view('teacher.editAttendance', ['attendanceRecord' => $attendance]);
    }

    public function update(Attendance $attendance, Request $request)
    {
        $attendance->update(['attendance' => $request->attendance]);
        return redirect('/attendance/edit/' . $attendance->id)->with('success', 'Attendance Updated successfully.');
    }

    public function destroy(Request $request)
    {

        $course_id = (int) $request->courseId;
        $deleted = Attendance::where('course_id', $course_id)->delete();
        return response()->json([ 'message' => $deleted ? 'Records deleted successfully' : 'Something went wrong pls try again!' ], $deleted ? 200 : 400);
    }

    public function indexTeacherAttendance()
    {

        $data['formattedCurrentDate'] = Carbon::now()->format('F j, Y \a\t h:i A');
        $data['isPunchedIn'] = TeacherAttendance::where('teacher_id', auth()->user()->id)->where('attendance_date', date('Y-m-d'))->where('punch_in', '!=', '00:00')->exists();
        $data['isPunchedOut'] = TeacherAttendance::where('teacher_id', auth()->user()->id)->where('attendance_date', date('Y-m-d'))->where('punch_out', '!=', '00:00')->exists();
        $data['attendanceRecords'] = TeacherAttendance::where('teacher_id', auth()->user()->id)->get();

        return view('teacher.teacherAttendance', $data);
    }

    public function storePunchInAttendanceAjax(Request $request)
    {

        $currentDateStr = strtotime(str_replace("at", "", $request->current_date));

        $currentDateOnly = date('Y-m-d', $currentDateStr);

        $currentTimeOnly = date('H:i', $currentDateStr);

        $todaysAttendanceRecord = TeacherAttendance::where('teacher_id', auth()->user()->id)
            ->where('attendance_date', $currentDateOnly)
            ->first();

        if ($request->punch_mode === 'punch_in') {

            TeacherAttendance::create([
                'teacher_id' => auth()->user()->id,
                'attendance_date' => $currentDateOnly,
                'punch_in' => $currentTimeOnly,
                'punch_out' => '00:00',
                'status' => ''
            ]);

        } else {

            TeacherAttendance::where('teacher_id', auth()->user()->id)
                ->where('attendance_date', $currentDateOnly)
                ->first()
                ->update(['punch_out' => $currentTimeOnly]);
        }


        return response()->json(['status' => true, 'message' => 'Attendance Punched In Successfully.']);
    }

}
