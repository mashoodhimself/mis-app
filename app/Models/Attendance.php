<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['registration_no', 'student_name', 'semester', 'section', 'attendance', 'attendance_date'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
