<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ExaminationController;

Route::get('/teacher/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');
Route::post('/teacher/login', [TeacherAuthController::class, 'login'])->name('teacher.login.post');

Route::get('/student/login', [LoginController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [LoginController::class, 'login'])->name('student.login.post');

Route::middleware('auth:teacher')->group(function () {
    Route::resource('groups', GroupController::class);
    Route::resource('students', StudentController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('examinations', ExaminationController::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth:student')->group(function () {
    Route::get('/dashboard/{student}', [LoginController::class, 'dashboard'])->name('student.dashboard');
});
