<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\SubmissionApiController;
use App\Http\Controllers\Api\ExaminationApiController;
use App\Http\Controllers\Api\ExportController;

Route::post('/student/login', [AuthController::class, 'studentLogin']);
Route::post('/teacher/login', [AuthController::class, 'teacherLogin']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('students', StudentController::class);
    Route::apiResource('groups', GroupController::class);
    Route::apiResource('attendances', AttendanceController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('examinations', ExaminationApiController::class);

    Route::middleware('ability:teacher')->group(function () {
        Route::get('submissions', [SubmissionApiController::class, 'index']);
        Route::put('submissions/{submission}', [SubmissionApiController::class, 'update']);

        Route::get('examinations/export/excel', [ExportController::class, 'exportExcel']);
        Route::get('examinations/export/pdf', [ExportController::class, 'exportPDF']);
    });

    Route::middleware('ability:student')->group(function () {
        Route::post('submissions', [SubmissionApiController::class, 'store']);
    });
});
