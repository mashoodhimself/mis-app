<?php

namespace App\Models;

use App\Models\User;
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

}
