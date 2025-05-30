<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class ExcelService 
{
    public static function readAndProcessAttendanceFile($requestData): array
    {
        $course_id = $requestData['course_id'];

        $attendance_date = $requestData['attendance_date'];

        $attendance_file = $requestData['attendance_file'];

        $excelRecords = Excel::toArray(new Collection(), $attendance_file)[0];

        $attendanceData = [];

        foreach($excelRecords as $index => $excelRow) {

            if($excelRow[0] !== 'Registration_no' && $excelRow[1] !== 'Name' && $excelRow[2] !== 'Semester' && $excelRow[3] !== 'Section' && $excelRow[3] !== 'Attendance') {
                array_push($attendanceData, [
                    'course_id' => $course_id,
                    'registration_no' => $excelRow[0],
                    'student_name' => $excelRow[1],
                    'semester' => $excelRow[2],
                    'section' => $excelRow[3],
                    'attendance' => $excelRow[4],
                    'attendance_date' => $attendance_date,
                    'added_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return $attendanceData;
    }

    public static function readAndProcessMarksFile($validatedRequest): array
    {
        $course_id = $validatedRequest['course_id'];
        $marksFile = $validatedRequest['marks_file'];

        $excelRecords = Excel::toArray(new Collection(), $marksFile)[0];

        $marksData = [];

        $counter = 0;

        foreach($excelRecords as $index => $excelRow) {

            if($counter === 0 || count(array_filter($excelRow)) === 0) {
                $counter++;
                continue;
            }

            $registration_no = "";
            $student_name = "";

            $quizes = [];
            $assignments = [];
            $classNumbers = [];

            $midTermMarks = 0;

            foreach($excelRow as $columnIndex => $columnValue) {

                $registration_no = trim($excelRow[0]);

                $student_name = trim($excelRow[1]);
                
                // Quiz Numbers
                if(in_array($columnIndex, [2, 3, 4, 5, 6, 7])) {
                    $quizes[] = empty($columnValue) || $columnValue === '-' ? 0 : $columnValue;
                }

                // Assignment Numbers
                if(in_array($columnIndex, [8, 9, 10, 11, 12, 13])) {
                    $assignments[] = empty($columnValue) || $columnValue === '-' ? 0 : $columnValue;
                }

                // Class Numbers
                if(in_array($columnIndex, [14, 15, 16])) {
                    $classNumbers[] = empty($columnValue) || $columnValue === '-' ? 0 : $columnValue;
                }

                $midTermMarks = $columnIndex === 19 && empty($columnValue) || $columnValue === '-' ? 0 : $columnValue;

            }

            $totalInternalMarks = array_sum(array_merge($quizes, $assignments, $classNumbers));

            $finalSessionalMarks = ceil($totalInternalMarks);

            $quizes = serialize($quizes);

            $assignments = serialize($assignments);

            $classNumbers = serialize($classNumbers);

            array_push($marksData, [
                'course_id' => $course_id,
                'registration_no' => $registration_no,
                'quizes_marks' => $quizes,
                'assignment_marks' => $assignments,
                'class_marks' => $classNumbers,
                'total_marks' => $totalInternalMarks,
                'final_sessional_marks' => $finalSessionalMarks,
                'mid_term_marks' => $midTermMarks,
                'added_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return $marksData;
    }

    public static function readAndProcessResultsFile($validatedRequest)
    {
        $course_id = $validatedRequest['course_id'];
        $resultsFile = $validatedRequest['results_file'];

        $excelRecords = Excel::toArray(new Collection(), $resultsFile)[0];

        $resultsData = [];

        $counter = 0;

        foreach($excelRecords as $index => $excelRow) {

            if($counter === 0 || count(array_filter($excelRow)) === 0) {
                $counter++;
                continue;
            }

            array_push($resultsData, [
                'course_id' => $course_id,
                'registration_no' => $excelRow[0],
                'sessional_marks' => $excelRow[1],
                'midterm_marks' => $excelRow[2],
                'final_marks' => $excelRow[3],
                'final_score' => $excelRow[4],
                'normalized_score' => $excelRow[5],
                'grade' => $excelRow[6],
                'gpa' => $excelRow[7],
                'added_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        
        return $resultsData;
    }

}