<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::with('group', 'latestAttendance')->get();

        return view('students.index', compact('students'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name'   => 'required',
            'last_name'    => 'required',
            'phone'        => 'required|unique:students,phone',
            'parent_phone' => 'required',
            'group_id'     => 'required|exists:groups,id',
            'password'     => 'required'
        ]);

        $teacher = Auth::user();

        $student = Student::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'phone'        => $request->phone,
            'parent_phone' => $request->parent_phone,
            'group_id'     => $request->group_id,
            'teacher_id'   => $teacher->id,
            'password'     => bcrypt($request->password),
        ]);

        return response()->json($student, 201);
    }


    public function show(Student $student)
    {
        return response()->json($student);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:students,phone,' . $student->id,
            'group_id' => 'required|exists:groups,id',
        ]);

        $student->update($request->all());

        return response()->json($student);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
