<?php

namespace Database\Seeders;

use App\Models\Course;
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
        Course::upsert([
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
        ], ['code']);
    }
}
