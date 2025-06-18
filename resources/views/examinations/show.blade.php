@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(to right, #bfdbfe, #ddd6fe, #fbcfe8);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 700px;
            margin: 3rem auto;
            padding: 2rem 2.5rem;
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
            transition: box-shadow 0.3s ease;
        }
        .container:hover {
            box-shadow: 0 12px 28px rgba(59, 130, 246, 0.5);
        }
        h1, h2 {
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 1rem;
            text-align: center;
        }
        .exam-info {
            font-size: 1.1rem;
            color: #334155;
            margin-bottom: 2rem;
            text-align: center;
        }
        .submissions-list {
            list-style: none;
            padding: 0;
        }
        .submission-card {
            border: 1px solid #d1d5db;
            border-radius: 20px;
            padding: 1.5rem 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
            transition: box-shadow 0.3s ease;
        }
        .submission-card:hover {
            box-shadow: 0 6px 18px rgba(59, 130, 246, 0.3);
        }
        .submission-card p {
            margin: 0.4rem 0;
            color: #334155;
            font-weight: 600;
        }
        .submission-card p strong {
            color: #1e293b;
        }
        a.file-link {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
        }
        a.file-link:hover {
            text-decoration: underline;
        }
        .back-link {
            display: block;
            max-width: 700px;
            margin: 1.5rem auto;
            text-align: center;
        }
        .back-link a {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
            font-size: 1rem;
            border: 1.5px solid #3b82f6;
            padding: 0.5rem 1.5rem;
            border-radius: 16px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .back-link a:hover {
            background-color: #3b82f6;
            color: white;
        }
    </style>

    <div class="container">
        <h1>Examination Details</h1>
        <div class="exam-info">
            <p><strong>Subject:</strong> {{ $examination->subject }}</p>
            <p><strong>Exam Date:</strong> {{ \Carbon\Carbon::parse($examination->exam_date)->format('d M Y') }}</p>
        </div>

        <h2>Submissions</h2>

        @if($examination->submissions->count() > 0)
            <ul class="submissions-list">
                @foreach ($examination->submissions as $submission)
                    <li class="submission-card">
                        <p><strong>Student:</strong> {{ $submission->student->first_name }}</p>
                        <p><strong>Content:</strong> {{ $submission->content }}</p>
                        <p><strong>File:</strong>
                            @if ($submission->file_path)
                                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="file-link">View File</a>
                            @else
                                No File
                            @endif
                        </p>
                        <p><strong>Score:</strong> {{ $submission->score ?? 'Not graded yet' }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p style="text-align:center; font-weight:600; color:#555;">No submissions found for this exam.</p>
        @endif
    </div>

    <div class="back-link">
        <a href="{{ route('examinations.index') }}">← Back to Examinations List</a>
    </div>
@endsection
