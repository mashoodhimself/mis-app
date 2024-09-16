<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('auth')->group(function() {
    
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/login');
    });

    Route::get('/teachers', [UserController::class, 'viewTeachers']);

    Route::get('/students', [UserController::class, 'viewStudents']);

    Route::get('/teacher/add', [UserController::class, 'viewTeacherAdd']);

    Route::post('/teacher/add', [UserController::class, 'storeTeacher']);

    Route::get('/teacher/edit/{teacher}', [UserController::class, 'editTeacher']);

    Route::post('/teacher/edit/{teacher}', [UserController::class, 'updateTeacher']);

    Route::get('/teacher/delete/{teacher}', [UserController::class, 'destroyTeacher']);

    Route::get('/student/add', [UserController::class, 'viewStudentAdd']);

    Route::post('/student/add', [UserController::class, 'storeStudent']);

    Route::get('/student/edit/{student}', [UserController::class, 'editStudent']);

    Route::post('/student/edit/{student}', [UserController::class, 'updateStudent']);

    Route::get('/student/delete/{student}', [UserController::class, 'destroyStudent']);

    Route::get('/courses', [CourseController::class, 'index']);

    Route::get('/course/add', [CourseController::class, 'create']); 

    Route::post('/course/add', [CourseController::class, 'store']); 

    Route::get('/course/edit/{course}', [CourseController::class, 'edit']);

    Route::post('/course/edit/{course}', [CourseController::class, 'update']);

    Route::get('/course/delete/{course}', [CourseController::class, 'destroy']);

});



Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);


