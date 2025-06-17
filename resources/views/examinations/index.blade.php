@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Examinations</h1>
    <a href="{{ route('examinations.create') }}" class="btn btn-primary mb-3">Add New Examination</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Subject</th>
                <th>Exam Date</th>
                <th>Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($exams as $exam)
                <tr>
                    <td>{{ $exam->student->first_name }} {{ $exam->student->last_name }}</td>
                    <td>{{ $exam->subject }}</td>
                    <td>{{ $exam->exam_date }}</td>
                    <td>{{ $exam->score ?? 'Not Graded' }}</td>
                    <td>
                        <a href="{{ route('examinations.edit', $exam->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('examinations.destroy', $exam->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No Examinations Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
