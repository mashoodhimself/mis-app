<?php

namespace App\Services;

use App\Mail\UserCreationMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserService
{

    public static function createUser($userData)
    {
        $password = \Str::random(12);
        
        $insertUserData = [
            'name' => $userData['name'],
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => bcrypt($password),
            'role' => $userData['role']
        ];

        if($userData['isStudent'] === true) {
            $insertUserData['registration_no'] = $userData['registration_no'];
            $insertUserData['semester'] = $userData['semester'];
            $insertUserData['section'] = $userData['section'];
        }

        $insertUserData['password'] = $password;

        DB::transaction(function () use ($insertUserData) {
            User::create($insertUserData);
            Mail::to($insertUserData['email'])->queue(new UserCreationMail($insertUserData));
        });

    }

    public static function updateUser(User $user, array $userData)
    {
        $updateUserData = [
                'name' => $userData['name'],
                'role' => $userData['role']
        ];

        if($userData['isStudent'] === true) {
            $updateUserData['registration_no'] = $userData['registration_no'];
            $updateUserData['semester'] = $userData['semester'];
            $updateUserData['section'] = $userData['section'];
        }

        $user->update($updateUserData);
    }

    public static function getAllActiveTeachers()
    {
        return User::where('role', 'teacher')
                ->where('status', 1)
                ->select('id', 'name')
                ->get();
    }

    public static function getStudentNameOnRegistrationNo($registration_no)
    {
        $user = User::select('name')->where('registration_no', $registration_no)->first();
        return $user->name;
    }
}
