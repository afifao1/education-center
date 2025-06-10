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
        h1 {
            font-weight: 800;
            font-size: 2rem;
            color: #1e293b;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .btn-add, .btn-students {
            padding: 0.5rem 1.25rem;
            border-radius: 16px;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
            color: white;
            display: inline-block;
        }
        .btn-add {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            margin-right: 0.75rem;
        }
        .btn-add:hover {
            background: linear-gradient(to right, #2563eb, #7c3aed);
            transform: scale(1.05);
        }
        .btn-students {
            background: linear-gradient(to right, #10b981, #059669); /* green colors */
        }
        .btn-students:hover {
            background: linear-gradient(to right, #047857, #065f46);
            transform: scale(1.05);
        }
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border: 1px solid #d1d5db;
            border-radius: 16px;
            transition: box-shadow 0.3s ease;
        }
        li:hover {
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        .group-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: #334155;
        }
        .actions {
            display: flex;
            gap: 0.5rem;
        }
        .btn-edit, .btn-delete {
            padding: 0.3rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-edit {
            background: #facc15; /* yellow-400 */
        }
        .btn-edit:hover {
            background: #eab308; /* yellow-500 */
            transform: scale(1.05);
        }
        .btn-delete {
            background: #ef4444; /* red-500 */
        }
        .btn-delete:hover {
            background: #dc2626; /* red-600 */
            transform: scale(1.05);
        }
        form {
            margin: 0;
        }
    </style>

    <div class="container">
        <div class="header">
            <h1>Groups</h1>
            <div>
                <a href="{{ route('groups.create') }}" class="btn-add">Add Group</a>
                <a href="{{ route('students.index') }}" class="btn-students">Students</a>
            </div>
        </div>

        <ul>
            @foreach ($groups as $group)
                <li>
                    <span class="group-name">{{ $group->name }}</span>
                    <div class="actions">
                        <a href="{{ route('groups.edit', $group) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('groups.destroy', $group) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
