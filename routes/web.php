<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\SubmissionController;

Route::get('/teacher/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');
Route::post('/teacher/login', [TeacherAuthController::class, 'login'])->name('teacher.login.post');
Route::post('/teacher/logout', [TeacherAuthController::class, 'logout'])->name('teacher.logout');

Route::get('/student/login', [LoginController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [LoginController::class, 'login'])->name('student.login.post');
Route::post('/student/logout', [LoginController::class, 'logout'])->name('student.logout');

Route::middleware('auth:teacher')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('groups', GroupController::class);
    Route::resource('students', StudentController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('examinations', ExaminationController::class);

    Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::put('/submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
});

Route::middleware('auth:student')->group(function () {
    Route::get('/dashboard/{student}', [LoginController::class, 'dashboard'])->name('student.dashboard');

    Route::get('/examinations/{examination}/submissions/create', [SubmissionController::class, 'create'])->name('submissions.create');

    Route::post('/submissions', [SubmissionController::class, 'store'])->name('submissions.store');
});
