@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Examination</h1>

    <form action="{{ route('examinations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Exam Date</label>
            <input type="date" name="exam_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Score</label>
            <input type="number" name="score" class="form-control" min="0" max="100">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('examinations.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
