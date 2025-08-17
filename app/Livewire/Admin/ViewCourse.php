<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class ViewCourse extends Component
{
    use WithPagination;

    protected $listeners = ['confirmDelete' => 'destroy'];

    public function confirmDelete(string $id)
    {
        $this->dispatch('delete-course-confirmation', id: $id);
    }

    public function destroy($id)
    {
        try {
            Course::findOrFail(id: $id)->delete();
            session()->flash('success', 'Course deleted successfully..');  
        } catch (\Exception $e) {
            \Log::error("Exception occured while deleting a course " . $e->getMessage());
            session()->flash('error', 'Something went wrong while deleting a course, pls try again.');
        }
    }

    public function render()
    {
        $courses = Course::select('id', 'title', 'code', 'credit')->simplePaginate(10);
        return view('livewire.admin.view-course', ['courses' => $courses])->layout('layouts.app');
    }
}
