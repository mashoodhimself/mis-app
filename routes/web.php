<?php

use App\Http\Controllers\Teacher\TeacherCourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AjaxHandlerController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Teacher\MarkController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Teacher\ResultController;
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

    Route::get('/student/attendance', [StudentController::class, 'adminAttendanceIndex']);

    Route::post('/student/attendance', [StudentController::class, 'adminAttendanceIndex']);

    Route::get('/student/marks', [StudentController::class, 'adminMarksIndex']);

    Route::get('/courses', [CourseController::class, 'index']);

    Route::get('/course/add', [CourseController::class, 'create']);

    Route::post('/course/add', [CourseController::class, 'store']);

    Route::get('/course/edit/{course}', [CourseController::class, 'edit']);

    Route::post('/course/edit/{course}', [CourseController::class, 'update']);

    Route::get('/course/delete/{course}', [CourseController::class, 'destroy']);

    Route::get('/attendance/view/{course_id}', [StudentController::class, 'attendanceIndex']);

    Route::get('/attendance/edit/{attendance}', [StudentController::class, 'attendanceEdit']);

    Route::post('/attendance/edit/{attendance}', [StudentController::class, 'attendanceUpdate']);

    Route::get('/attendance/upload/{course_id}', [StudentController::class, 'attendanceCreate']);

    Route::get('/attendance/teacher', [AttendanceController::class, 'indexTeacherAttendance']);

    Route::post('/attendance/upload', [StudentController::class, 'attendanceStore']);

    Route::get('/marks/view/{course_id}', [StudentController::class, 'marksIndex']);

    Route::get('/marks/upload/{course_id}', [StudentController::class, 'marksCreate']);

    Route::post('/marks/upload', [StudentController::class, 'marksStore']);

    Route::get('/results/view/{course_id}', [StudentController::class, 'resultIndex']);

    Route::get('/results/upload/{course_id}', [StudentController::class, 'resultCreate']);

    Route::post('/results/upload', [StudentController::class, 'resultStore']);

    Route::get('/results/graph/{course_id}', [StudentController::class, 'gradeDistributionGraph']);

    Route::get('/teacher/course', [TeacherCourseController::class, 'index']);

    Route::get('/feed', [FeedController::class, 'index']);
    Route::get('/feed/add', [FeedController::class, 'create']);
    Route::post('/feed/add', [FeedController::class, 'store']);
    Route::get('/feed/edit/{feed}', [FeedController::class, 'edit']);
    Route::post('/feed/edit', [FeedController::class, 'update']);
    Route::delete('/feed/destroy/{feed}', [FeedController::class, 'destroy']);

    /** Ajax Related Routes */
    Route::post('/marks/detail', [AjaxHandlerController::class, 'getMarksById']);
    Route::post('/attendance/destroy', [StudentController::class, 'attendanceDestroy']);
    Route::post('/marks/destroy', [StudentController::class, 'marksDestroy']);
    Route::post('/results/destroy', [StudentController::class, 'resultDestroy']);
    Route::post('/attendance/teacher', [AttendanceController::class, 'storePunchInAttendanceAjax']);
    Route::post('/results/graph', [StudentController::class, 'getGradeCountByCourseId']);
    /** Ajax Routes End */

});



Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
