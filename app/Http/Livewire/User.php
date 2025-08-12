<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Exception;
use Livewire\Component;
use App\Models\User as UserModel;

class User extends Component
{
    public $full_name;
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $user_role = 'teacher';
    public $isStudent = false;
    public $semester = '1st';
    public $section = 'A';
    public $registration_no;
    public $operationStatus;

    protected $rules = [
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:50|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|same:confirm_password',
        'confirm_password' => 'required|min:8',
        'user_role' => 'required',
        'registration_no' => 'required_if:user_role,student',
        'semester' => 'required',
        'section' => 'required'
    ];


    public function render()
    {
        return view('livewire.user');
    }

    public function updatedUserRole($value)
    {
        $this->isStudent = $value === 'student';
        if(!$this->isStudent) {
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
            session()->flash('error', 'User created successfully...');
            \Log::error("Error occured while creating a user: " . $e->getMessage());

        } finally {
            $this->reset('full_name', 'username', 'email', 'password', 'confirm_password', 'user_role', 'registration_no', 'semester', 'section');
            $this->user_role = 'teacher';
            $this->isStudent = false;
        }

    }

}
