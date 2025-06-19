<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\Student;
use Illuminate\Http\Request;

class ExaminationApiController extends Controller
{
    public function index()
    {
        $examinations = Examination::with(['student', 'submissions'])->get();

        return response()->json([
            'status' => true,
            'message' => 'Examinations list retrieved successfully.',
            'data' => $examinations
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject' => 'required|string',
            'exam_date' => 'required|date',
            'score' => 'nullable|integer|min:0|max:100',
        ]);

        $examination = Examination::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Examination successfully added!',
            'data' => $examination
        ], 201);
    }

    public function show($id)
    {
        $examination = Examination::with(['student', 'submissions'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Examination details retrieved successfully.',
            'data' => $examination
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $examination = Examination::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject' => 'required|string',
            'exam_date' => 'required|date',
            'score' => 'nullable|integer|min:0|max:100',
        ]);

        $examination->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Examination successfully updated!',
            'data' => $examination
        ], 200);
    }

    public function destroy($id)
    {
        $examination = Examination::findOrFail($id);
        $examination->delete();

        return response()->json([
            'status' => true,
            'message' => 'Examination successfully deleted!'
        ], 200);
    }
}
