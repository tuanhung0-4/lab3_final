<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Course Management
Route::controller(CourseController::class)->group(function () {
    Route::get('/courses/trashed', 'trashed')->name('courses.trashed');
    Route::post('/courses/{id}/restore', 'restore')->name('courses.restore');
});
Route::resource('courses', CourseController::class);

// Lesson Management
Route::resource('lessons', LessonController::class);

// Enrollment Management
Route::resource('enrollments', EnrollmentController::class)->only(['index', 'create', 'store']);
