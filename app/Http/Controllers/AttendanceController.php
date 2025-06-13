<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('student')->orderBy('date', 'desc')->get();
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $students = Student::all();
        return view('attendance.create', compact('students'));
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
    // dd($validated); 

    Attendance::create([
        'student_id' => $validated['student_id'],
        'date' => $validated['date'],
        'status' => $validated['status'],
        'late_minutes' => $validated['status'] === 'late' ? ($validated['late_minutes'] ?? 0) : null,
    ]);

    return redirect()->route('attendances.index')->with('success', 'Attendance successfully added!');
}
}
