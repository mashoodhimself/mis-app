<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::upsert([
            [
                'name' => 'Mashhood',
                'email' => 'mashoodahmad50@gmail.com',
                'username' => 'mashoodhimself',
                'password' => bcrypt("admin"),
                'role' => 'admin',
                'registration_no' => null,
                'semester' => null,
                'section' => null,
            ],[
                'name' => 'Aizaz',
                'email' => 'aizaz762@gmail.com',
                'username' => 'aizaz762',
                'password' => bcrypt("admin"),
                'role' => 'teacher',
                'registration_no' => null,
                'semester' => null,
                'section' => null,
            ],[
                'name' => 'Haseeb',
                'email' => 'haseeb@gmail.com',
                'username' => 'haseeb',
                'password' => bcrypt("admin"),
                'role' => 'chairman',
                'registration_no' => null,
                'semester' => null,
                'section' => null,
            ],[
                'name' => 'Abubakar',
                'email' => 'abubakar@gmail.com',
                'username' => 'abubakar',
                'password' => bcrypt("admin"),
                'role' => 'student',
                'registration_no' => '16pwbcs0543',
                'semester' => '8th',
                'section' => 'B',
            ],[
                'name' => 'Umar',
                'email' => 'umar@gmail.com',
                'username' => 'Umar',
                'password' => bcrypt("admin"),
                'role' => 'student',
                'registration_no' => '16pwbcs0544',
                'semester' => '9th',
                'section' => 'B',
            ],[
                'name' => 'Usman',
                'email' => 'usman@gmail.com',
                'username' => 'Usman',
                'password' => bcrypt("admin"),
                'role' => 'student',
                'registration_no' => '16pwbcs0545',
                'semester' => '10th',
                'section' => 'B',
            ],[
                'name' => 'Ali',
                'email' => 'ali@gmail.com',
                'username' => 'Ali',
                'password' => bcrypt("admin"),
                'role' => 'student',
                'registration_no' => '16pwbcs0546',
                'semester' => '11th',
                'section' => 'B',
            ],
        ], ['email']);
    }
}
