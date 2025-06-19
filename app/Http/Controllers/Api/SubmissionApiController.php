<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionApiController extends Controller
{
    public function index(Request $request)
    {
        $submissions = Submission::with(['student', 'examination'])->get();

        return response()->json([
            'status' => true,
            'message' => 'Submissions list retrieved successfully.',
            'data' => $submissions
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'examination_id' => 'required|exists:examinations,id',
            'content' => 'required|string',
            'file' => 'nullable|file|max:5120',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('submissions', 'public');
        }

        $submission = Submission::create([
            'examination_id' => $request->examination_id,
            'student_id' => Auth::id(),
            'content' => $request->content,
            'file_path' => $path,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Submission successfully created!',
            'data' => $submission
        ], 201);
    }

    public function update(Request $request, Submission $submission)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
        ]);

        $submission->update([
            'score' => $request->score,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Submission successfully graded!',
            'data' => $submission
        ], 200);
    }
}
