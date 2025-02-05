<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AjaxHandlerController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Teacher\MarkController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Teacher\AttendanceController;

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


Route::middleware('auth')->group(function () {

    Route::get('/', function () {

        return view('dashboard');
    });

    Route::get('/logout', function () {
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

    Route::get('/student/attendance', [StudentController::class, 'attendanceIndex']);

    Route::post('/student/attendance', [StudentController::class, 'attendanceIndex']);

    Route::get('/courses', [CourseController::class, 'index']);

    Route::get('/course/add', [CourseController::class, 'create']);

    Route::post('/course/add', [CourseController::class, 'store']);

    Route::get('/course/edit/{course}', [CourseController::class, 'edit']);

    Route::post('/course/edit/{course}', [CourseController::class, 'update']);

    Route::get('/course/delete/{course}', [CourseController::class, 'destroy']);

    Route::get('/attendance/view', [AttendanceController::class, 'index']);

    Route::get('/attendance/edit/{attendance}', [AttendanceController::class, 'edit']);

    Route::post('/attendance/edit/{attendance}', [AttendanceController::class, 'update']);

    Route::get('/attendance/upload', [AttendanceController::class, 'create']);

    Route::post('/attendance/upload', [AttendanceController::class, 'store']);

    Route::get('/marks/view', [MarkController::class, 'index']);

    Route::get('/marks/upload', [MarkController::class, 'create']);

    Route::post('/marks/upload', [MarkController::class, 'store']);

    /** Ajax Related Routes */
    Route::post('/marks/detail', [AjaxHandlerController::class, 'getMarksById']);
    /** Ajax Routes End */

});



Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
