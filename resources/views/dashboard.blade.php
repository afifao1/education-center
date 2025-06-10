<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, {{ auth()->user()->first_name }}!</h2>

    <form method="POST" action="{{ route('teacher.logout') }}">
        @csrf
        <button type="submit">Exit</button>
    </form>
</body>
</html>
