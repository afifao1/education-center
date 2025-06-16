@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Add Payment</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('payments.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-semibold">Student:</label>
                <select name="student_id" required class="w-full border p-2 rounded">
                    <option value="">Select a student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Amount:</label>
                <input type="number" name="amount" step="0.01" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Payment Method:</label>
                <select name="payment_method" required class="w-full border p-2 rounded">
                    <option value="cash">cash</option>
                    <option value="card">card</option>
                    <option value="online">online</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Payment Date:</label>
                <input type="date" name="payment_date" required class="w-full border p-2 rounded">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Save Payment
            </button>
        </form>
    </div>
@endsection
