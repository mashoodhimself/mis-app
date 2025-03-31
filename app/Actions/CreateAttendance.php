<?php 

namespace App\Actions;

use App\Models\Attendance;
use App\Services\ExcelService;

final class CreateAttendance
{
    public static function handle($validatedData)
    {
        try {
            $attendanceData = ExcelService::readAndProcessAttendanceFile($validatedData);
            Attendance::insert($attendanceData);
            $responseData = ['status' => 'success', 'message' => 'Attendance Upload Successfully.'];
        } catch(Exception $e) {
            $responseData = ['status' => 'error', 'message' => 'Failed To Upload Attendance.'];
        }
        
        return $responseData;
    }
}