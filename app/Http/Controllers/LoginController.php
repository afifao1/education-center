<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        $student = Student::where('phone', $request->phone)
                    ->orWhere('parent_phone', $request->phone)
                    ->first();

        if ($student && Hash::check($request->password, $student->password)) {
            Auth::guard('student')->login($student);
            return redirect()->route('student.dashboard', $student->id);
        }

        return back()->withErrors(['phone' => 'Phone or password incorrect']);
    }

    public function dashboard(Student $student)
    {
        if (Auth::guard('student')->id() != $student->id) {
            return redirect()->route('student.login')->withErrors(['access' => 'Unauthorized']);
        }
    
        $student->load([
            'group',
            'submissions.examination',
            'payments'
        ]);
    
        $examinations = \App\Models\Examination::all();
    
        return view('student.dashboard', compact('student', 'examinations'));
    }



    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login');
    }

}
