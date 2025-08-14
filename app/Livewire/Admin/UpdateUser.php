<?php

namespace App\Livewire\Admin;

use Exception;
use App\Models\User;
use Livewire\Component;
use App\Services\UserService;

class UpdateUser extends Component
{
    public $name;
    public $username;
    public $email;
    public $role;
    public $isStudent;
    public $semester;
    public $section;
    public $registration_no;

    public User $user;

    protected $rules = [
        'name' => 'required|string|max:255',
        'role' => 'required',
        'registration_no' => 'required_if:role,student',
        'semester' => 'required',
        'section' => 'required'
    ];

    public function mount(User $user)
    {  

        $this->user = $user;

        $this->fill( $user->only('name', 'username', 'email', 'role'));

        if( $this->role === 'student') {
            $this->semester = $user->semester;
            $this->section = $user->section;
            $this->registration_no = $user->registration_no;
        } else {
            $this->semester = '1st';
            $this->section = 'A';
            $this->registration_no = '';
        }

        $this->isStudent = $user->role === 'student';
    }  
    
    public function updatedRole($value)
    {
        $this->isStudent = $this->role === 'student';
    }

    public function update()
    {   
        try {
            $validated = $this->validate();
            $validated['isStudent'] = $this->isStudent;
            UserService::updateUser($this->user, $validated);
            session()->flash('success', 'User updated successfully...');
        } catch (Exception $e) {
            \Log::error("Error occured while updating user record: " . $e->getMessage());
            session()->flash('error', 'Something went wrong, while updating user...');
        }
    }

    public function render()
    {
        return view('livewire.admin.update-user')->layout('layouts.app');
    }
}
