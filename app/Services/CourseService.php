<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseAssignment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class CourseService
{
    public static function createCourse($courseData)
    {
        DB::transaction(function () use ($courseData) {
            $user_id = $courseData["user_id"];
            unset($courseData["user_id"]);
            $course = Course::create($courseData);
            CourseAssignment::create(["user_id" => $user_id, "course_id" => $course->id]);
        });
    }

    public static function updateCourse($courseData)
    {
        DB::transaction(function () use ($courseData) {
            $user_id = $courseData["user_id"];
            $course_id = $courseData["id"];
            $updatedData = collect($courseData)->except(['user_id', 'id'])->toArray();
            $course = Course::findOrFail($course_id);
            $course->update($updatedData);
            CourseAssignment::where('course_id', $course_id)->update(['user_id' => $user_id]);
        });
    }

    public static function getUserCourseByID($course_id)
    {
        return CourseAssignment::select('user_id', 'course_id')->where('course_id', $course_id)->first();
    }

    public static function getAssignedCourses(): Collection
    {
        return Course::with(['assigned_courses' => fn ($query) => $query->where('user_id', '!=', 0)])
                ->whereHas('assigned_courses', fn ($query) => $query->where('user_id', '!=', 0))
                ->get();
    }

}
