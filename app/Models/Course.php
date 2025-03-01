<?php

namespace App\Models;

use App\Models\Mark;
use App\Models\User;
use App\Models\Result;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function users()
    {
        return $this->belongsToMany(User::class, 'course_assignments');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function results()
    {
        return $this->hasOne(Result::class);
    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }

}
