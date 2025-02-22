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

    public function getThisTeacherCoursesHavingResults($teacherId)
    {
        return DB::table('courses')
            ->join('course_assignments', 'course_assignments.course_id', '=', 'courses.id')
            ->join('results', 'results.course_id', '=', 'course_assignments.course_id')
            ->select([
                'courses.id',
                'courses.title'
            ])
            ->where('course_assignments.user_id', $teacherId)
            ->where('courses.status', 1)
            ->groupBy(['courses.id', 'courses.title'])
            ->get();
    }

    public function getThisTeacherCoursesHavingMarks($teacherId)
    {
        return DB::table('courses')
            ->join('course_assignments', 'course_assignments.course_id', '=', 'courses.id')
            ->join('marks', 'marks.course_id', '=', 'course_assignments.course_id')
            ->select([
                'courses.id',
                'courses.title'
            ])
            ->where('course_assignments.user_id', $teacherId)
            ->where('courses.status', 1)
            ->groupBy(['courses.id', 'courses.title'])
            ->get();
    }


}
