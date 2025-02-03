<?php

namespace App\Services;

use App\Models\CourseAssignment;
use Illuminate\Support\Facades\DB;

class CourseAssignmentService
{
    public function __construct(private CourseAssignment $courseAssignment = new CourseAssignment())
    {

    }

    public function getCourseByUserId(int $user_id): object|null
    {
        return $this->courseAssignment->where('user_id', $user_id)->first();
    }

    public function getUserByCourseId(int $course_id): object|null
    {
        return $this->courseAssignment->where('course_id', $course_id)->first();
    }

    public function getAssignedCourses(): object
    {
        return DB::table('courses')
            ->join('course_assignments', 'course_assignments.course_id', '=', 'courses.id')
            ->select('courses.id', 'courses.title as course_name')
            ->get();

    }


}
