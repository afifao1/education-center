<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function studentLogin(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        $student = Student::where('phone', $request->phone)
                    ->orWhere('parent_phone', $request->phone)
                    ->first();

        if ($student && Hash::check($request->password, $student->password)) {
            $token = $student->createToken('student_token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'student' => $student
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function teacherLogin(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        $teacher = \App\Models\Teacher::where('phone', $request->phone)->first();

        if ($teacher && Hash::check($request->password, $teacher->password)) {
            $token = $teacher->createToken('teacher_token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'teacher' => $teacher
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
