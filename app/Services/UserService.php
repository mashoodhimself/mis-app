<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{

    public static function createUser($userData)
    {
        $insertUserData = [
                'name' => $userData['full_name'],
                'username' => $userData['username'],
                'email' => $userData['email'],
                'password' => bcrypt($userData['password']),
                'role' => $userData['user_role']
        ];

        if($userData['isStudent'] === true) {
            $insertUserData['registration_no'] = $userData['registration_no'];
            $insertUserData['semester'] = $userData['semester'];
            $insertUserData['section'] = $userData['section'];
        }

        User::create($insertUserData);
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
