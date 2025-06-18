<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-cyan-200 via-blue-200 to-purple-200 min-h-screen font-sans p-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-4xl font-bold text-gray-800 mb-10 text-center animate-fade-in-down">📚 Students List</h2>

        <div class="flex justify-between items-center mb-10 flex-wrap gap-4">
            <a href="{{ route('students.create') }}"
               class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-5 py-2 rounded-lg shadow hover:scale-105 hover:opacity-90 transition transform duration-300">
                ➕ Add Student
            </a>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('groups.index') }}"
                   class="bg-gradient-to-r from-green-500 to-green-700 text-white px-5 py-2 rounded-lg shadow hover:scale-105 hover:opacity-90 transition transform duration-300">
                    📂 Groups
                </a>

                <a href="{{ route('examinations.index') }}"
                   class="bg-gradient-to-r from-purple-500 to-purple-700 text-white px-5 py-2 rounded-lg shadow hover:scale-105 hover:opacity-90 transition transform duration-300">
                    📝 Examinations
                </a>

                <a href="{{ route('submissions.index') }}"
                   class="bg-gradient-to-r from-pink-500 to-pink-700 text-white px-5 py-2 rounded-lg shadow hover:scale-105 hover:opacity-90 transition transform duration-300">
                    📤 Submissions
                </a>

                <a href="{{ route('payments.index') }}"
                   class="bg-gradient-to-r from-yellow-500 to-yellow-700 text-white px-5 py-2 rounded-lg shadow hover:scale-105 hover:opacity-90 transition transform duration-300">
                    💰 Payments
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-green-100 text-green-700 p-4 rounded shadow text-center text-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-gray-200 text-gray-700 text-lg">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">First Name</th>
                        <th class="px-6 py-4">Last Name</th>
                        <th class="px-6 py-4">Phone</th>
                        <th class="px-6 py-4">Parent Phone</th>
                        <th class="px-6 py-4">Group</th>
                        <th class="px-6 py-4">Latest Status</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $student->id }}</td>
                            <td class="px-6 py-4">{{ $student->first_name }}</td>
                            <td class="px-6 py-4">{{ $student->last_name }}</td>
                            <td class="px-6 py-4">{{ $student->phone }}</td>
                            <td class="px-6 py-4">{{ $student->parent_phone }}</td>
                            <td class="px-6 py-4">{{ $student->group->name ?? 'No Group' }}</td>
                            <td class="px-6 py-4">
                                @if ($student->latestAttendance)
                                    @if ($student->latestAttendance->status === 'present')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            Present
                                        </span>
                                    @elseif ($student->latestAttendance->status === 'late')
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            Late
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            Absent
                                        </span>
                                    @endif
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        No Attendance
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex flex-wrap gap-2 justify-center">
                                <a href="{{ route('attendances.index') }}"
                                   class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">
                                    Attendance
                                </a>

                                <a href="{{ route('students.edit', $student->id) }}"
                                   class="bg-yellow-400 text-white px-4 py-1 rounded hover:bg-yellow-500 transition">
                                    Edit
                                </a>

                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Do you want to delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($students->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500 text-lg">
                                No students found.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
