<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    protected $fillable = ['teacher_id', 'attendance_date', 'punch_in', 'punch_out', 'status'];
}
