<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
</head>
<body>

    <h2>Student Login</h2>

    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.login.post') }}" method="POST">
        @csrf
        <label>Phone (Student or Parent):</label><br>
        <input type="text" name="phone" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

</body>
</html>
