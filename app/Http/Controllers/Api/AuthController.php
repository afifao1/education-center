<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function studentLogin(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $student = Student::where('phone', $request->phone)->first();

        if ($student && Hash::check($request->password, $student->password)) {
            $token = $student->createToken('student_token', ['student'])->plainTextToken;

            return response()->json([
                'message' => 'Student logged in successfully.',
                'token' => $token,
                'student' => $student
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    public function teacherLogin(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $teacher = Teacher::where('phone', $request->phone)->first();

        if ($teacher && Hash::check($request->password, $teacher->password)) {
            $token = $teacher->createToken('teacher_token', ['teacher'])->plainTextToken;

            return response()->json([
                'message' => 'Teacher logged in successfully.',
                'token' => $token,
                'teacher' => $teacher
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }
}
