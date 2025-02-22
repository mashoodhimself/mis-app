<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
   protected $fillable = ['course_id', 'registration_no', 'sessional_marks', 'midterm_marks', 'final_marks', 'final_score', 'normalized_score', 'grade', 'gpa'];

   public function course()
   {
    return $this->belongsTo(Course::class);
   }

}
