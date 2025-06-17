<?php
namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Student;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function index()
    {
        $exams = Examination::with('student')->orderBy('exam_date', 'desc')->get();
        return view('examinations.index', compact('exams'));
    }

    public function create()
    {
        $students = Student::all();
        return view('examinations.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject' => 'required|string',
            'exam_date' => 'required|date',
            'score' => 'nullable|integer|min:0|max:100',
        ]);

        Examination::create($validated);

        return redirect()->route('examinations.index')->with('success', 'Examination successfully added!');
    }

    public function edit($id)
    {
        $exam = Examination::findOrFail($id);
        $students = Student::all();

        return view('examinations.edit', compact('exam', 'students'));
    }

    public function update(Request $request, $id)
    {
        $exam = Examination::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject' => 'required|string',
            'exam_date' => 'required|date',
            'score' => 'nullable|integer|min:0|max:100',
        ]);

        $exam->update($validated);

        return redirect()->route('examinations.index')->with('success', 'Examination successfully updated!');
    }

    public function destroy($id)
    {
        $exam = Examination::findOrFail($id);
        $exam->delete();

        return redirect()->route('examinations.index')->with('success', 'Examination successfully deleted!');
    }
}
