<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\PaymentController;

Route::post('/student/login', [AuthController::class, 'studentLogin']);
Route::post('/teacher/login', [AuthController::class, 'teacherLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('students', StudentController::class);

    Route::apiResource('groups', GroupController::class);
    Route::apiResource('attendances', AttendanceController::class);
    Route::apiResource('payments', PaymentController::class);

});
