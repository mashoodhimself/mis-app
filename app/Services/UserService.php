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
        $queryResult = DB::table('users')
            ->join('user_metas', 'users.id', '=', 'user_metas.user_id')
            ->where('user_metas.key', 'registration_no')
            ->where('user_metas.value', $registration_no)
            ->select('users.name as student_name')
            ->get();

        return $queryResult[0]->student_name;

    }
}
