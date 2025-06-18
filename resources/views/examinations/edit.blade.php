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
        select, input[type="text"], input[type="date"], input[type="number"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 16px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.25rem;
        }
        select:focus, input[type="text"]:focus, input[type="date"]:focus, input[type="number"]:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        button {
            width: 100%;
            padding: 0.75rem 1rem;
            background: linear-gradient(to right, #22c55e, #16a34a); 
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
            margin-top: 0.5rem;
        }
        button:hover {
            background: linear-gradient(to right, #15803d, #14532d);
            transform: scale(1.05);
        }
        .btn-secondary {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 1rem;
            padding: 0.75rem 1rem;
            background: #64748b;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 16px;
            text-decoration: none;
            user-select: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        .btn-secondary:hover {
            background: #475569;
            transform: scale(1.05);
        }
    </style>

    <div class="container">
        <h1>Edit Examination</h1>

        <form action="{{ route('examinations.update', $exam->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="student_id">Student</label>
            <select name="student_id" id="student_id" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $exam->student_id ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>

            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" value="{{ $exam->subject }}" required>

            <label for="exam_date">Exam Date</label>
            <input type="date" name="exam_date" id="exam_date" value="{{ $exam->exam_date }}" required>

            <button type="submit">Update</button>
        </form>

        <a href="{{ route('examinations.index') }}" class="btn-secondary">Back</a>
    </div>
@endsection
