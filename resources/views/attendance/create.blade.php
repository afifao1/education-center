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
        h2 {
            font-weight: 800;
            font-size: 2rem;
            color: #1e293b;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        label {
            display: block;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #334155;
        }
        select, input {
            width: 100%;
            padding: 0.6rem 1rem;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            font-size: 1rem;
            outline: none;
            transition: border 0.3s ease;
        }
        select:focus, input:focus {
            border-color: #3b82f6;
        }
        .btn-submit {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 16px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            width: 100%;
        }
        .btn-submit:hover {
            background: linear-gradient(to right, #2563eb, #7c3aed);
            transform: scale(1.03);
        }
        .btn-back {
            display: inline-block;
            margin-top: 1rem;
            background: linear-gradient(to right, #10b981, #059669);
            color: white;
            padding: 0.6rem 1.25rem;
            border-radius: 16px;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .btn-back:hover {
            background: linear-gradient(to right, #047857, #065f46);
            transform: scale(1.05);
        }
        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 1rem;
        }
    </style>

    <div class="container">
        <h2>Add Attendance</h2>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Student:</label>
                <select name="student_id" required>
                    <option value="">Select a student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Date:</label>
                <input type="date" name="date" required>
            </div>

            <div class="form-group">
                <label>Status:</label>
                <select name="status" required>
                    <option value="present">Present</option>
                    <option value="late">Late</option>
                    <option value="absent">Absent</option>
                </select>
            </div>

            <div class="form-group">
                <label>Late Minutes (if Late):</label>
                <input type="number" name="late_minutes" placeholder="Enter late minutes">
            </div>

            <button type="submit" class="btn-submit">Save Attendance</button>
        </form>

        <a href="{{ route('attendances.index') }}" class="btn-back">⬅️ Back to Attendances</a>
    </div>
@endsection
