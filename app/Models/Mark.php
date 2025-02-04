<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = ['course_id', 'registration_no', 'quizes_marks', 'assignment_marks', 'class_marks', 'total_marks', 'final_sessional_marks', 'mid_term_marks', 'added_by'];
}
