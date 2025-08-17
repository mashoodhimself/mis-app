<?php

namespace App\Livewire\Admin;

use App\Models\Result;
use Livewire\Component;
use App\Services\CourseService;

class ViewResult extends Component
{

    public $results;

    public $course_id;

    public function mount()
    {
        $this->results = collect([]);
        $this->course_id = 0;
    }

    public function filter()
    {
        $resultsByCourse = Result::select('id', 'registration_no', 'sessional_marks', 'midterm_marks', 'final_marks', 'final_score', 'normalized_score', 'grade', 'gpa')->where('course_id', $this->course_id)
        ->get();
        $this->results = $resultsByCourse;
    }

    public function render()
    {
        $assignedCourses = CourseService::getAssignedCourses();
        return view('livewire.admin.view-result', ['assignedCourses' => $assignedCourses])->layout('layouts.app');
    }
}
