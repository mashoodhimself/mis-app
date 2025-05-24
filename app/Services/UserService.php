<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
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
