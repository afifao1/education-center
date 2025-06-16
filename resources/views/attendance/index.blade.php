@extends('layouts.app')

@section('content')
    <style>
        body { background: linear-gradient(to right, #bfdbfe, #ddd6fe, #fbcfe8); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .container { max-width: 720px; margin: 3rem auto; padding: 1.5rem 2rem; background: white; border-radius: 24px; box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3); transition: box-shadow 0.3s ease; }
        .container:hover { box-shadow: 0 12px 28px rgba(59, 130, 246, 0.5); }
        h1 { font-weight: 800; font-size: 2rem; color: #1e293b; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .btn-add, .btn-groups { padding: 0.5rem 1.25rem; border-radius: 16px; font-weight: 700; font-size: 1rem; text-decoration: none; transition: background 0.3s ease, transform 0.3s ease; color: white; display: inline-block; }
        .btn-add { background: linear-gradient(to right, #3b82f6, #8b5cf6); margin-right: 0.75rem; }
        .btn-add:hover { background: linear-gradient(to right, #2563eb, #7c3aed); transform: scale(1.05); }
        .btn-groups { background: linear-gradient(to right, #10b981, #059669); }
        .btn-groups:hover { background: linear-gradient(to right, #047857, #065f46); transform: scale(1.05); }
        ul { list-style: none; padding: 0; margin: 0; }
        li { padding: 1rem 1.5rem; border: 1px solid #d1d5db; border-radius: 16px; transition: box-shadow 0.3s ease; margin-bottom: 1rem; }
        li:hover { box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }
        .attendance-info { font-size: 1.125rem; font-weight: 600; color: #334155; text-align: left; margin-bottom: 0.5rem; }
        .status-badge { padding: 0.3rem 0.75rem; border-radius: 12px; font-weight: 600; font-size: 0.9rem; display: inline-block; margin-left: 0.5rem; }
        .status-present { background: #bbf7d0; color: #166534; }
        .status-late { background: #fef08a; color: #92400e; }
        .status-absent { background: #fecaca; color: #991b1b; }
        .action-buttons { display: flex; gap: 0.5rem; margin-top: 0.5rem; }
        .action-btn { padding: 0.4rem 0.75rem; border-radius: 12px; font-weight: 600; font-size: 0.9rem; text-decoration: none; color: white; transition: background 0.3s ease, transform 0.3s ease; }
        .edit-btn { background: linear-gradient(to right, #f59e0b, #f97316); }
        .edit-btn:hover { background: linear-gradient(to right, #d97706, #ea580c); transform: scale(1.05); }
        .delete-btn { background: linear-gradient(to right, #ef4444, #dc2626); border: none; cursor: pointer; }
        .delete-btn:hover { background: linear-gradient(to right, #b91c1c, #991b1b); transform: scale(1.05); }
    </style>

    <div class="container">
        <div class="header">
            <h1>Attendances</h1>
            <div>
                <a href="{{ route('attendances.create') }}" class="btn-add">➕ Add Attendance</a>
                <a href="{{ route('groups.index') }}" class="btn-groups">👥 Groups</a>
            </div>
        </div>

        @if (session('success'))
            <div style="color: green; margin-bottom: 1rem; font-weight: bold;">
                {{ session('success') }}
            </div>
        @endif

        <ul>
            @foreach ($attendances as $attendance)
                <li>
                    <div class="attendance-info">
                        {{ $attendance->student->first_name }} {{ $attendance->student->last_name }} <br>
                        {{ $attendance->date }}
                        <span class="status-badge
                            @if ($attendance->status === 'present') status-present
                            @elseif ($attendance->status === 'late') status-late
                            @else status-absent @endif">
                            @if ($attendance->status === 'present')
                                Present
                            @elseif ($attendance->status === 'late')
                                Late ({{ $attendance->late_minutes }} min)
                            @else
                                Absent
                            @endif
                        </span>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('attendances.edit', $attendance->id) }}" class="action-btn edit-btn">✏️ Edit</a>

                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this attendance?')">🗑️ Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
