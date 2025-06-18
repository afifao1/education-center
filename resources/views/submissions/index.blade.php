@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(to right, #bfdbfe, #ddd6fe, #fbcfe8);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 640px;
            margin: 3rem auto;
            padding: 1.5rem 2rem;
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
            transition: box-shadow 0.3s ease;
        }
        .container:hover {
            box-shadow: 0 12px 28px rgba(59, 130, 246, 0.5);
        }
        h1 {
            font-weight: 800;
            font-size: 2rem;
            color: #1e293b;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 1rem 1.5rem;
            border-radius: 16px;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            box-shadow: 0 0 8px rgba(16, 185, 129, 0.4);
        }
        .card {
            border: 1px solid #d1d5db;
            border-radius: 20px;
            padding: 1.5rem 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 6px 18px rgba(59, 130, 246, 0.3);
        }
        .card p {
            margin: 0.4rem 0;
            color: #334155;
            font-weight: 600;
        }
        .card p strong {
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
        form.score-form {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
            align-items: center;
        }
        input[type="number"] {
            flex-grow: 1;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 16px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input[type="number"]:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        button[type="submit"] {
            padding: 0.5rem 1.5rem;
            background: linear-gradient(to right, #10b981, #059669);
            color: white;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        button[type="submit"]:hover {
            background: linear-gradient(to right, #047857, #065f46);
            transform: scale(1.05);
        }
    </style>

    <div class="container">
        <h1>Submissions</h1>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @foreach ($submissions as $submission)
            <div class="card">
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

                <form action="{{ route('submissions.update', $submission->id) }}" method="POST" class="score-form" novalidate>
                    @csrf
                    @method('PUT')
                    <input type="number" name="score" min="0" max="100" required placeholder="Enter score" value="{{ old('score') }}">
                    <button type="submit">Assign Score</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
