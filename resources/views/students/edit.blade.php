<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>

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

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>First Name:</label><br>
        <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}"><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}"><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}"><br><br>

        <label>Parent Phone:</label><br>
        <input type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}"><br><br>

        <label>Group:</label><br>
        <select name="group_id" required>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}" {{ $student->group_id == $group->id ? 'selected' : '' }}>
                    {{ $group->name }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
