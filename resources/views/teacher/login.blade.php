<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center font-sans transition-colors duration-500">

    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl w-full max-w-md animate-fade-in">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-6">👩‍🏫 Teacher Login</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-300 text-red-700 dark:text-red-900 rounded-lg shadow">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('teacher.login.post') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">📞 Phone Number:</label>
                <input type="text" name="phone" required class="w-full border rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">🔑 Password:</label>
                <input type="password" name="password" required class="w-full border rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white py-2 rounded-xl transition transform hover:scale-105">
                Login
            </button>
        </form>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
</body>
</html>
