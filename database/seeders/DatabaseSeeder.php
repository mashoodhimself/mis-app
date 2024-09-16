<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        \App\Models\User::insert([[
            'name' => 'Mashhood',
            'email' => 'mashoodahmad50@gmail.com',
            'username' => 'mashoodhimself',
            'password' => bcrypt("admin"),
            'role' => 'admin'
        ],[
            'name' => 'Aizaz',
            'email' => 'aizaz762@gmail.com',
            'username' => 'aizaz762',
            'password' => bcrypt("admin"),
            'role' => 'teacher'
        ],[
            'name' => 'Haseeb',
            'email' => 'haseeb@gmail.com',
            'username' => 'haseeb',
            'password' => bcrypt("admin"),
            'role' => 'chairman'
        ],[
            'name' => 'Muneeb',
            'email' => 'Muneeb@gmail.com',
            'username' => 'muneeb',
            'password' => bcrypt("admin"),
            'role' => 'student'
        ]]);


        \App\Models\Role::create([
            'name' => 'admin',
            'description' => 'admin role'
        ]);

        \App\Models\Role::create([
            'name' => 'teacher',
            'description' => 'teacher role'
        ]);

        \App\Models\Role::create([
            'name' => 'chairman',
            'description' => 'chairman role'
        ]);

        \App\Models\Role::create([
            'name' => 'student',
            'description' => 'student role'
        ]);
    }
}
