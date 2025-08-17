<?php

namespace App\Livewire\Admin;

use App\Models\Mark;
use Livewire\Component;
use App\Services\CourseService;

class ViewMarks extends Component
{

    public $course_id;
    public $marks;
    public $mark;
    public $quizMarks;
    public $assignmentMarks;
    public $classMarks;

    public function mount()
    {
        $this->course_id = 0;
        $this->marks = collect([]);
        $this->quizMarks = [];
        $this->classMarks = [];
        $this->assignmentMarks = [];
        $this->show = true;
    }

    public function showMarkDetail($id)
    {   
        $marks = Mark::select('quizes_marks', 'assignment_marks', 'class_marks')->findOrFail($id);
        $this->quizMarks = unserialize($marks->quizes_marks);
        $this->classMarks = unserialize($marks->class_marks);
        $this->assignmentMarks = unserialize($marks->assignment_marks);
        $this->dispatch('open-mark-modal');
    }

    public function filter()
    {
        $marksByCourse = Mark::select('id', 'registration_no', 'total_marks', 'final_sessional_marks', 'mid_term_marks')->where('course_id', $this->course_id)
        ->get();
        $this->marks = $marksByCourse;
    }

    public function render()
    {   
        $assignedCourses = CourseService::getAssignedCourses();
        return view('livewire.admin.view-marks', ['assignedCourses' => $assignedCourses])->layout('layouts.app');
    }
}
