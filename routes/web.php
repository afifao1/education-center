<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GroupController;
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');
Route::post('/login', [TeacherAuthController::class, 'login'])->name('teacher.login.post');
Route::post('/logout', [TeacherAuthController::class, 'logout'])->name('teacher.logout');

Route::middleware('auth:teacher')->group(function () {
    Route::resource('groups', GroupController::class);
    Route::resource('students', StudentController::class);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

