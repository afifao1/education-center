<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body>
    <h2>Welcome, {{ $student->first_name }} {{ $student->last_name }}</h2>

    <p>Phone: {{ $student->phone }}</p>
    <p>Parent Phone: {{ $student->parent_phone }}</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
