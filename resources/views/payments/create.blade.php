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
    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 16px;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 1rem;
    }
    input[type="text"]:focus,
    input[type="date"]:focus,
    select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }
    button {
        width: 100%;
        padding: 0.75rem 1rem;
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
        color: white;
        font-weight: 700;
        font-size: 1.125rem;
        border: none;
        border-radius: 16px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.3s ease;
    }
    button:hover {
        background: linear-gradient(to right, #2563eb, #7c3aed);
        transform: scale(1.05);
    }
</style>

<div class="container">
    <h1>Add Payment</h1>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <label for="student_id">Student:</label>
        <select name="student_id" id="student_id" required>
            <option value="">Select a student</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
            @endforeach
        </select>

        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount" required>

        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method" required>
            <option value="cash">Cash</option>
            <option value="card">Card</option>
            <option value="online">Online</option>
        </select>

        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" id="payment_date" required>

        <button type="submit">Add Payment</button>
    </form>
</div>
@endsection
