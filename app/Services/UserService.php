<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function getAllActiveTeachers()
    {
        return User::where('role', 'teacher')
                ->where('status', 1)
                ->select('id', 'name')
                ->get();
    }
}