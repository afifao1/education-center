@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Attendance</h2>

        @if ($errors->any())
            <div style="color: red;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

            <div>
                <label>Student:</label>
                <select name="student_id" required>
                    <option value="">Select Student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Date:</label>
                <input type="date" name="date" required>
            </div>

            <div>
                <label>Status:</label>
                <select name="is_present" required>
                    <option value="1">Present</option>
                    <option value="0">Absent</option>
                </select>
            </div>

            <div>
                <label>Late Minutes (if late):</label>
                <input type="number" name="late_minutes" min="0" placeholder="Enter minutes if late">
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
@endsection
