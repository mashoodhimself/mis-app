<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class ExcelService 
{
    public static function readAndProcessAttendanceFile($attendanceFile, $attendance_date): array
    {
        $excelRecords = Excel::toArray(new Collection(), $attendanceFile)[0];

        $attendanceData = [];

        foreach($excelRecords as $index => $excelRow) {
            if($excelRow[0] !== 'Registration_no' && $excelRow[1] !== 'Name' && $excelRow[2] !== 'Semester' && $excelRow[3] !== 'Section' && $excelRow[3] !== 'Attendance') {
                array_push($attendanceData, [
                    'registration_no' => $excelRow[0],
                    'student_name' => $excelRow[1],
                    'semester' => $excelRow[2],
                    'section' => $excelRow[3],
                    'attendance' => $excelRow[4],
                    'attendance_date' => $attendance_date,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return $attendanceData;
    }
}