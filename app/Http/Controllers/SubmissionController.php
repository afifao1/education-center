<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function create(Examination $examination)
    {
        return view('submissions.create', compact('examination'));
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

        Submission::create([
            'examination_id' => $request->examination_id,
            'student_id' => Auth::id(),
            'content' => $request->content,
            'file_path' => $path,
        ]);

        return redirect()->route('examinations.index')->with('success', 'Work submitted successfully!');
    }

    public function index(Request $request)
    {
        $submissions = Submission::with('student')->get();
        return view('submissions.index', compact('submissions'));
    }

    public function update(Request $request, Submission $submission)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
        ]);

        $submission->update([
            'score' => $request->score,
        ]);

        return redirect()->back()->with('success', 'Submission graded successfully!');
    }
}
