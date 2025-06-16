@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">✨ Payments List</h2>

    @if (session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-4 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <a href="{{ route('payments.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">+ Add Payment</a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full table-auto text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Student</th>
                    <th class="px-6 py-3">Payment Date</th>
                    <th class="px-6 py-3">Amount</th>
                    <th class="px-6 py-3">Payment Method</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $payment->id }}</td>
                        <td class="px-6 py-4">{{ $payment->student->first_name }} {{ $payment->student->last_name }}</td>
                        <td class="px-6 py-4">{{ $payment->payment_date }}</td>
                        <td class="px-6 py-4">${{ $payment->amount }}</td>
                        <td class="px-6 py-4">{{ $payment->payment_method }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('payments.edit', $payment->id) }}"
                               class="bg-yellow-400 text-white px-4 py-1 rounded hover:bg-yellow-500 transition">Edit</a>
                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Do you want to delete this payment?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No payments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
