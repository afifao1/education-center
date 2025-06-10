<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-yellow-100 to-pink-200 min-h-screen flex items-center justify-center font-sans">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-lg animate-fade-in">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">✏️ Edit Student</h2>

        <a href="{{ route('students.index') }}" class="text-blue-600 hover:underline mb-6 inline-block">⬅️ Back to List</a>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 p-4 rounded text-red-600">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.update', $student->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-medium">First Name:</label>
                <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <label class="block mb-1 font-medium">Last Name:</label>
                <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <label class="block mb-1 font-medium">Phone:</label>
                <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <label class="block mb-1 font-medium">Parent's Phone:</label>
                <input type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <label class="block mb-1 font-medium">Group:</label>
                <select name="group_id" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ $student->group_id == $group->id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white px-6 py-2 rounded-lg hover:opacity-90 transition duration-300">Update Student</button>
            </div>
        </form>
    </div>
</body>
</html>
