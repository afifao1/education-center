<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Group;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('group')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $groups = Group::all();
        return view('students.create', compact('groups'));
    }

public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'phone' => 'required|unique:students,phone',
        'parent_phone' => 'required',
        'group_id' => 'required|exists:groups,id',
    ]);

    Student::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'parent_phone' => $request->parent_phone,
        'group_id' => $request->group_id,
        'teacher_id' => auth('teacher')->user()->id,
        'password' => bcrypt($request->password),

    ]);

    return redirect()->route('students.index')->with('success', 'Student added successfully.');
}

    public function edit(Student $student)
    {
        $groups = Group::all();
        return view('students.edit', compact('student', 'groups'));
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

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
