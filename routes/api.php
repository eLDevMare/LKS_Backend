<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
 
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    // Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');

    Route::post('/course/post', [CourseController::class, 'addCourse'])->middleware('auth:api')->name('course.add');
    Route::delete('/course/{slug}', [CourseController::class, 'deleteCourse'])->middleware('auth:api')->name('course.delete'); 
    Route::get('/course', [CourseController::class, 'getAllCourse'])->middleware('auth:api')->name('course'); 
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);