<?php

namespace App\Livewire\Admin;

use App\Services\CourseService;
use Livewire\Component;

class CreateCourse extends Component
{
    public $title;
    public $code;
    public $credit;
    public $user_id = 0;

    protected $rules = [
        'title' => 'required|string|max:100',
        'code' => 'required|string|max:50',
        'credit' => 'required|max:1',
    ];

    public function save()
    {   
        $validated = $this->validate();
        $validated['user_id'] = $this->user_id;
        try {
            CourseService::createCourse($validated);
            session()->flash('success','New course added successfully..');
        } catch (\Exception $e) {
            session()->flash('error','Something went wrong while adding a course, pls try again later.');
            \Log::error("Error occured while adding a course: " . $e->getMessage());
        } finally {
            $this->reset('title', 'code', 'credit', 'user_id');
        }
    }

    public function render()
    {
        return view('livewire.admin.create-course')->layout('layouts.app');
    }
}
