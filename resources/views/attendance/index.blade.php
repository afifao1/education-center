@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Attendance List</h2>

        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('attendances.create') }}">Add New Attendance</a>

        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Late Minutes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->student->first_name }} {{ $attendance->student->last_name }}</td>
                        <td>{{ $attendance->date }}</td>
                        <td>{{ ucfirst($attendance->status) }}</td>
                        <td>
                            {{ $attendance->status === 'late' ? ($attendance->late_minutes . ' min') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No attendance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
