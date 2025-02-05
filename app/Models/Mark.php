<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mark extends Model
{
    protected $fillable = ['course_id', 'registration_no', 'quizes_marks', 'assignment_marks', 'class_marks', 'total_marks', 'final_sessional_marks', 'mid_term_marks', 'added_by'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
