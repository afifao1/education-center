@extends('layouts.app')

@section('content')
    <style>
        body { background: linear-gradient(to right, #bfdbfe, #ddd6fe, #fbcfe8); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .container { max-width: 480px; margin: 3rem auto; padding: 2rem; background: white; border-radius: 24px; box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3); transition: box-shadow 0.3s ease; }
        .container:hover { box-shadow: 0 12px 28px rgba(59, 130, 246, 0.5); }
        h1 { font-weight: 800; font-size: 2rem; margin-bottom: 1.5rem; text-align: center; color: #1e293b; }
        label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; }
        input, select { width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 16px; font-size: 1rem; outline: none; transition: border-color 0.3s ease, box-shadow 0.3s ease; margin-bottom: 1rem; }
        input:focus, select:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3); }
        button { width: 100%; padding: 0.75rem 1rem; background: linear-gradient(to right, #3b82f6, #8b5cf6); color: white; font-weight: 700; font-size: 1.125rem; border: none; border-radius: 16px; cursor: pointer; transition: background 0.3s ease, transform 0.3s ease; }
        button:hover { background: linear-gradient(to right, #2563eb, #7c3aed); transform: scale(1.05); }
    </style>

    <div class="container">
        <h1>Edit Attendance</h1>

        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="student_id">Student</label>
            <select name="student_id" id="student_id" required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $attendance->student_id ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>

            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="{{ $attendance->date }}" required>

            <label for="status">Status</label>
            <select name="status" id="status" required onchange="toggleLateInput(this.value)">
                <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                <option value="late" {{ $attendance->status == 'late' ? 'selected' : '' }}>Late</option>
                <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
            </select>

            <label for="late_minutes">Late Minutes (only if late)</label>
            <input type="number" name="late_minutes" id="late_minutes" min="0" value="{{ $attendance->late_minutes }}">

            <button type="submit">Update Attendance</button>
        </form>
    </div>

    <script>
        function toggleLateInput(status) {
            const lateInput = document.getElementById('late_minutes');
            lateInput.disabled = (status !== 'late');
        }
        document.addEventListener('DOMContentLoaded', function () {
            toggleLateInput(document.getElementById('status').value);
        });
    </script>
@endsection
