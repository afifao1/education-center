@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 900px;
        margin: 3rem auto;
        padding: 2rem;
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        transition: box-shadow 0.3s ease;
    }
    h1 {
        font-weight: 800;
        font-size: 2rem;
        color: #1e293b;
        margin-bottom: 2rem;
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-weight: 600;
        color: #334155;
    }
    thead {
        background: #3b82f6;
        color: white;
        font-weight: 700;
    }
    th, td {
        padding: 0.75rem 1rem;
        border: 1px solid #cbd5e1;
        text-align: left;
        vertical-align: middle;
    }
    tbody tr:hover {
        background: #e0e7ff;
    }
</style>

<div class="container">
    <h1>Examinations List</h1>

    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Exam Date</th>
                <th>Latest Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($examinations as $exam)
                <tr>
                    <td>{{ $exam->student->first_name }} {{ $exam->student->last_name }}</td>
                    <td>{{ $exam->subject }}</td>
                    <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('Y-m-d') }}</td>

                    <td>
                        @if($exam->submissions->isNotEmpty())
                            {{ $exam->submissions->sortByDesc('created_at')->first()->score ?? 'No score yet' }}
                        @else
                            No submissions
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('examinations.show', $exam->id) }}">View</a> |
                        <a href="{{ route('examinations.edit', $exam->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
