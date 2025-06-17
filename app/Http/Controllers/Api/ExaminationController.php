<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\Student;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function index()
    {
        $exams = Examination::with('student')->orderBy('exam_date', 'desc')->get();

        return response()->json(['success' => true, 'data' => $exams]);
    }

    public function show($id)
    {
        $exam = Examination::with('student')->find($id);

        if (!$exam) {
            return response()->json(['success' => false, 'message' => 'Examination not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $exam]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject' => 'required|string',
            'exam_date' => 'required|date',
            'score' => 'nullable|integer|min:0|max:100',
        ]);

        $exam = Examination::create($validated);

        return response()->json(['success' => true, 'message' => 'Examination successfully created!', 'data' => $exam], 201);
    }

    public function update(Request $request, $id)
    {
        $exam = Examination::find($id);

        if (!$exam) {
            return response()->json(['success' => false, 'message' => 'Examination not found'], 404);
        }

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject' => 'required|string',
            'exam_date' => 'required|date',
            'score' => 'nullable|integer|min:0|max:100',
        ]);

        $exam->update($validated);

        return response()->json(['success' => true, 'message' => 'Examination successfully updated!', 'data' => $exam]);
    }

    public function destroy($id)
    {
        $exam = Examination::find($id);

        if (!$exam) {
            return response()->json(['success' => false, 'message' => 'Examination not found'], 404);
        }

        $exam->delete();

        return response()->json(['success' => true, 'message' => 'Examination successfully deleted!']);
    }
}
