<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SetsController;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/course', [CourseController::class, 'getAllCourse'])->name('course'); 
    Route::get('/course/get/course', [CourseController::class, 'getMyCourse'])->name('course.me');
    Route::get('/course/{slug}', [CourseController::class, 'getDetailCourse'])->name('course.detail');
    Route::get('/course/other/course', [CourseController::class, 'getOtherCourse'])->name('course.other');
    Route::post('/course/post', [CourseController::class, 'addCourse'])->name('course.add');
    Route::post('/course/{slug}/register', [CourseController::class, 'courseRegister'])->name('course.register'); 
    Route::delete('/course/{slug}', [CourseController::class, 'deleteCourse'])->name('course.delete'); 
    Route::post('/course/{course_id}/sets', [SetsController::class, 'addSets'])->name('sets.add'); 
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');