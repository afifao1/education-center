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
            padding: 2rem 2.5rem;
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
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 16px;
            font-size: 1rem;
            outline: none;
            resize: vertical;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-family: inherit;
            color: #1e293b;
        }
        textarea:focus,
        input[type="file"]:focus {
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
        .alert-danger {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        ul {
            margin: 0;
            padding-left: 1.2rem;
        }
    </style>

    <div class="container">
        <h1>Submit your work for: {{ $examination->subject ?? 'Examination' }}</h1>

        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <input type="hidden" name="examination_id" value="{{ $examination->id }}">

            <div class="mb-4">
                <label for="content">Content (Text or Link) <span style="color: #dc2626;">*</span></label>
                <textarea name="content" id="content" rows="5" placeholder="Enter your text or paste the link here..." required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="file">Upload File (optional)</label>
                <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.txt,.zip,.rar,.jpg,.png">
            </div>

            <button type="submit">Submit Work</button>
        </form>
    </div>
@endsection
