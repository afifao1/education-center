@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(to right, #bfdbfe, #ddd6fe, #fbcfe8);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
        max-width: 960px;
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
        font-size: 2.5rem;
        margin-bottom: 2rem;
        text-align: center;
        color: #1e293b;
    }
    .add-btn {
        display: block;
        width: 200px;
        margin: 0 auto 2rem auto;
        padding: 0.75rem 1rem;
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
        color: white;
        font-weight: 700;
        font-size: 1.125rem;
        border: none;
        border-radius: 16px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: background 0.3s ease, transform 0.3s ease;
    }
    .add-btn:hover {
        background: linear-gradient(to right, #2563eb, #7c3aed);
        transform: scale(1.05);
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 0.75rem 1rem;
        text-align: center;
        border: 1px solid #d1d5db;
    }
    th {
        background-color: #3b82f6;
        color: white;
        font-size: 1rem;
    }
    td {
        font-size: 1rem;
    }
    .action-btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.3s ease;
        text-decoration: none;
        color: white;
    }
    .edit-btn {
        background: #10b981;
    }
    .edit-btn:hover {
        background: #059669;
        transform: scale(1.05);
    }
    .delete-btn {
        background: #ef4444;
    }
    .delete-btn:hover {
        background: #dc2626;
        transform: scale(1.05);
    }
</style>

<div class="container">
    <h1>Payments List</h1>

    <a href="{{ route('payments.create') }}" class="add-btn">Add Payment</a>

    @if (session('success'))
        <div style="color: green; margin-bottom: 1rem; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Payment Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->student->first_name }} {{ $payment->student->last_name }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ ucfirst($payment->payment_method) }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>
                        <a href="{{ route('payments.edit', $payment->id) }}" class="action-btn edit-btn">Edit</a>

                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this payment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No payments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
