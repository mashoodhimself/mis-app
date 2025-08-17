<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;
use App\Services\CourseService;

class UpdateCourse extends Component
{

    #[Locked]
    public $id;
    public $title;
    public $code;
    public $credit;
    public $user_id;

    protected $rules = [
        'title' => 'required|string|max:100',
        'code' => 'required|string|max:50',
        'credit' => 'required|max:1',
    ];

    public function mount(Course $course)
    {
        $this->fill( $course->only('id', 'title', 'code', 'credit'));
        $this->user_id = CourseService::getUserCourseByID($course->id)?->user_id;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['id'] = $this->id;
        $validated['user_id'] = $this->user_id;
        try {
            CourseService::updateCourse($validated);
            session()->flash('success', 'Course updated successfully...');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong while updating a course, pls try again later.');
            \Log::error("error occured while creating a course: " . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.update-course')->layout('layouts.app');
    }
}
