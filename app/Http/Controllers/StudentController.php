<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Group;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('group');
        if ($request->filled('name')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                  ->orWhere('last_name', 'like', '%' . $request->name . '%');
            });
        }
        if ($request->filled('date_of_birth')) {
            $date = \DateTime::createFromFormat('d.m.Y', $request->date_of_birth);
            if ($date) {
                $query->whereDate('date_of_birth', $date->format('Y-m-d'));
            }
        }
        $students = $query->get();
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
            'date_of_birth' => ['nullable', 'regex:/^\d{2}\.\d{2}\.\d{4}$/'],
        ]);

        $date_of_birth = $request->date_of_birth ? \DateTime::createFromFormat('d.m.Y', $request->date_of_birth) : null;

        Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'parent_phone' => $request->parent_phone,
            'group_id' => $request->group_id,
            'teacher_id' => auth('teacher')->user()->id,
            'password' => bcrypt($request->password),
            'date_of_birth' => $date_of_birth ? $date_of_birth->format('Y-m-d') : null,
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
            'date_of_birth' => ['nullable', 'regex:/^\d{2}\.\d{2}\.\d{4}$/'],
        ]);

        $data = $request->all();
        $data['date_of_birth'] = $request->date_of_birth ? (\DateTime::createFromFormat('d.m.Y', $request->date_of_birth))->format('Y-m-d') : null;
        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
