@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Examination</h1>

    <form action="{{ route('examinations.update', $exam->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $exam->student_id ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ $exam->subject }}" required>
        </div>

        <div class="mb-3">
            <label>Exam Date</label>
            <input type="date" name="exam_date" class="form-control" value="{{ $exam->exam_date }}" required>
        </div>

        <div class="mb-3">
            <label>Score</label>
            <input type="number" name="score" class="form-control" value="{{ $exam->score }}" min="0" max="100">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('examinations.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
