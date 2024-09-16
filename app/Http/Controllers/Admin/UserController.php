<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function viewTeachers() {
        $teachers = User::where('role', '=', 'teacher')->get();
        return view('admin.viewTeachers', ['teachers' => $teachers]);
    }

    public function viewStudents() {
        $students = User::where('role', '=', 'student')->get();
        return view('admin.viewStudents', ['students' => $students]);
    }

    public function viewTeacherAdd() {
        return view('admin.addTeacher');
    }

    public function storeTeacher(Request $request) {

        $request->validate([
            'full_name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);


        User::create([
            'name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'teacher' 
        ]);

        return redirect('/teachers')->with('success', 'New teacher added successfully.');

    }

    public function viewStudentAdd() {
        return view('admin.addStudent');
    }

    public function storeStudent(Request $request) {

        $request->validate([
            'full_name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student' 
        ]);

        return redirect('/students')->with('success', 'New student added successfully.');
    }

    public function editTeacher(User $teacher) {
        return view('admin.editTeacher', ['teacher' => $teacher]);
    }

    public function updateTeacher(User $teacher, Request $request) {

        $teacher->update([
            'name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect('/teachers')->with('success', 'Teacher updated successfully.');

    }

    public function destroyTeacher(User $teacher) {

        $teacher->roles()->delete();
        $teacher->delete();

        return redirect('/teachers')->with('success', 'Teacher deleted successfully.');

    }

    public function editStudent(User $student) {
        return view('admin.editStudent', ['student' => $student]);
    }

    public function updateStudent(User $student, Request $request) {

        $student->update([
            'name' => $request->full_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);

        return redirect('/students')->with('success', 'Student updated successfully.');
    }

    public function destroyStudent(User $student) {

        $student->roles()->delete();
        $student->delete();

        return redirect('/students')->with('success', 'Student deleted successfully.');
    }
}
