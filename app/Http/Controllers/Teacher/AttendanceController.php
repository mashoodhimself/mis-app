<?php 

namespace App\Http\Controllers\Teacher;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Services\ExcelService;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendanceRecords = Attendance::select('id', 'course_id', 'registration_no', 'student_name', 'semester', 'section', 'attendance', 'attendance_date')->get();
        return view('teacher.viewAttendance', ['attendanceRecords' => $attendanceRecords]);
    }

    public function create()
    {
        return view('teacher.uploadAttendance');
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
            
        } catch(Exception $e) {
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
}