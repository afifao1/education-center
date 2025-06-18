@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(to right, #bfdbfe, #ddd6fe, #fbcfe8);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 480px;
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
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #1e293b;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }
        select.form-control, input.form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 16px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: white;
        }
        select.form-control:focus, input.form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        button.btn-success, a.btn-secondary {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 16px;
            cursor: pointer;
            border: none;
            text-align: center;
            transition: background 0.3s ease, transform 0.3s ease;
            text-decoration: none;
            user-select: none;
        }
        button.btn-success {
            background: linear-gradient(to right, #10b981, #059669);
            color: white;
            margin-right: 0.75rem;
        }
        button.btn-success:hover {
            background: linear-gradient(to right, #047857, #065f46);
            transform: scale(1.05);
        }
        a.btn-secondary {
            background: #9ca3af;
            color: white;
        }
        a.btn-secondary:hover {
            background: #6b7280;
            transform: scale(1.05);
        }
        .mb-3 {
            margin-bottom: 1.25rem;
        }
    </style>

    <div class="container">
        <h1>Add New Examination</h1>

        <form action="{{ route('examinations.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="student_id">Student</label>
                <select name="student_id" id="student_id" class="form-control" required>
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="exam_date">Exam Date</label>
                <input type="date" name="exam_date" id="exam_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('examinations.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
