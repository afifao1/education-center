@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(to right, #bfdbfe, #ddd6fe, #fbcfe8);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 960px;
            margin: 3rem auto;
            padding: 2rem;
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
            font-size: 2.5rem;
            color: #1e293b;
            text-align: center;
            margin-bottom: 2rem;
        }

        .section {
            margin-bottom: 2rem;
        }

        .section h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #374151;
            margin-bottom: 1rem;
        }

        .card {
            border: 1px solid #d1d5db;
            border-radius: 20px;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 6px 18px rgba(59, 130, 246, 0.3);
        }

        .card p {
            margin: 0.3rem 0;
            color: #334155;
            font-weight: 600;
        }

        .card p strong {
            color: #1e293b;
        }

        a.btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 16px;
            cursor: pointer;
            border: none;
            text-align: center;
            transition: background 0.3s ease, transform 0.3s ease;
            text-decoration: none;
            user-select: none;
            background: linear-gradient(to right, #10b981, #059669);
            color: white;
        }

        a.btn:hover {
            background: linear-gradient(to right, #047857, #065f46);
            transform: scale(1.05);
        }
    </style>

    <div class="container">
        <h1>Welcome, {{ $student->first_name }}!</h1>

        <div class="section">
            <h2>Your Group</h2>
            <div class="card">
                <p><strong>Group Name:</strong> {{ $student->group->name ?? 'No Group Assigned' }}</p>
            </div>
        </div>

        <div class="section">
            <h2>Your Examinations</h2>
            @forelse ($student->submissions as $submission)
                <div class="card">
                    <p><strong>Subject:</strong> {{ $submission->examination->subject }}</p>
                    <p><strong>Score:</strong> {{ $submission->score ?? 'Not Graded Yet' }}</p>
                </div>
            @empty
                <p>No examinations submitted yet.</p>
            @endforelse
        </div>

        <div class="section">
            <h2>Your Payments</h2>
            @forelse ($student->payments as $payment)
                <div class="card">
                    <p><strong>Amount:</strong> ${{ $payment->amount }}</p>
                    <p><strong>Date:</strong> {{ $payment->payment_date }}</p>
                </div>
            @empty
                <p>No payments found.</p>
            @endforelse
        </div>

        <div class="section">
            <h2>Available Examinations</h2>
            @forelse ($examinations as $exam)
                <div class="card">
                    <p><strong>Subject:</strong> {{ $exam->subject }}</p>
                    <p><strong>Exam Date:</strong> {{ $exam->exam_date }}</p>
                    <a href="{{ route('submissions.create', $exam->id) }}" class="btn">Submit Exam</a>
                </div>
            @empty
                <p>No available examinations.</p>
            @endforelse
        </div>
    </div>
@endsection
