<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('student')->orderBy('date', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $attendances
        ]);
    }

    public function show($id)
    {
        $attendance = Attendance::with('student')->find($id);

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Attendance not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $attendance
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => [
                'required',
                'date',
                Rule::unique('attendances')->where(function ($query) use ($request) {
                    return $query->where('student_id', $request->student_id);
                }),
            ],
            'status' => 'required|in:present,late,absent',
            'late_minutes' => 'nullable|integer|min:0',
        ]);

        $attendance = Attendance::create([
            'student_id' => $validated['student_id'],
            'date' => $validated['date'],
            'status' => $validated['status'],
            'late_minutes' => $validated['status'] === 'late' ? ($validated['late_minutes'] ?? 0) : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Attendance successfully created!',
            'data' => $attendance
        ], 201);
    }
}
