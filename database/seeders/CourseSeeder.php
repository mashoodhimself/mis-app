<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseAssignment;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $courses = [
            [
                'title' => 'Introduction to Programming',
                'code' => 'CS-101',
                'credit' => 4,
                'status' => 1,
            ],[
                'title' => 'Databases',
                'code' => 'CS-102',
                'credit' => 4,
                'status' => 1,
            ],[
                'title' => 'Operating Systems',
                'code' => 'CS-103',
                'credit' => 4,
                'status' => 1,
            ], 
            [
                'title' => 'Networking',
                'code' => 'CS-104',
                'credit' => 4,
                'status' => 1,
            ], 
        ];

        foreach ($courses as $course) { 
            $c = Course::create($course);
            CourseAssignment::create(['user_id' => 0, 'course_id' => $c->id]);
        }
        
    }
}
