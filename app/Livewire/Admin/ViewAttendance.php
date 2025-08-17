<?php

namespace App\Livewire\Admin;

use App\Models\Attendance;
use App\Services\CourseService;
use Livewire\Component;

class ViewAttendance extends Component
{
    public $course_id;
    public $attendance_date;

    public $attendance;

    


    public function mount()
    {
        $this->attendance = collect([]);
        $this->course_id = 0;
    }

    public function filter()
    {

        $attendanceByCourse = Attendance::select('id', 'registration_no', 'student_name', 'semester', 'section', 'attendance', 'attendance_date')
        ->where('course_id', $this->course_id)
        ->when($this->attendance_date, function ($query, $date) {
            return $query->where('attendance_date', $date);
        })
        ->get();

        $this->attendance = $attendanceByCourse;
    }

    public function render()
    {
        $assignedCourses = CourseService::getAssignedCourses();
        return view('livewire.admin.view-attendance', ['assignedCourses' => $assignedCourses])->layout('layouts.app');
    }
}
