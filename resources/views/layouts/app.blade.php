<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
</head>
<body>
    @if(Auth::guard('student')->check())
    <nav style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 2rem;">
        <a href="{{ route('student.dashboard', auth()->id()) }}" class="btn btn-primary">Dashboard</a>
        <a href="{{ route('student.logout') }}" class="btn btn-danger"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
    @endif
    @yield('content')
</body>
</html>
