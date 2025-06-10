<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
    <h2>Add New Student</h2>

    <a href="{{ route('students.index') }}">⬅️ Back to List</a>

    @if ($errors->any())
        <div style="color:red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <label>First Name:</label><br>
        <input type="text" name="first_name" value="{{ old('first_name') }}"><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" value="{{ old('last_name') }}"><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}"><br><br>

        <label>Parent's Phone:</label><br> 
        <input type="text" name="parent_phone" value="{{ old('parent_phone') }}"><br><br>

        <label>Group:</label><br>
        <select name="group_id" required>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Save</button>
    </form>
</body>
</html>
