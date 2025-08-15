<?php

namespace App\Livewire\Admin;

use Exception;
use Livewire\Component;
use App\Services\UserService;

class CreateUser extends Component
{
    #[Locked]
    public $name;
    #[Locked]
    public $username;
    #[Locked]
    public $email;
    #[Locked]
    public $role;
    #[Locked]
    public $isStudent;
    #[Locked]
    public $semester;
    #[Locked]
    public $section;
    #[Locked]
    public $registration_no;
    #[Locked]
    public $operationStatus;

    protected $rules = [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:50|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'role' => 'required',
        'registration_no' => 'required_if:role,student',
        'semester' => 'required',
        'section' => 'required'
    ];

    public function mount()
    {
        $this->role = 'teacher';
        $this->semester = '1st';
        $this->section = 'A';
        $this->isStudent = false;
    }

    public function render()
    {
        return view('livewire.admin.create-user')->layout('layouts.app');
    }

    public function updatedRole($value)
    {
        $this->isStudent = $value === 'student';
        if (!$this->isStudent) {
            $this->reset('registration_no', 'semester', 'section');
        }
    }

    public function save()
    {
        $validated = $this->validate();
        $validated['isStudent'] = $this->isStudent;

        try {
            UserService::createUser($validated);
            session()->flash('success', 'User created successfully...');

        } catch (Exception $e) {
            session()->flash('error', 'Something went wrong while creating a user, pls try again later.');
            \Log::error("Error occured while creating a user: " . $e->getMessage());

        } finally {
            $this->reset('name', 'username', 'email', 'role', 'registration_no', 'semester', 'section');
            $this->role = 'teacher';
            $this->isStudent = false;
        }

    }
}
