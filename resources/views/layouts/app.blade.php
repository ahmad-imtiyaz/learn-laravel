<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Dashboard')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { display: flex; min-height: 100vh; }
    .sidebar {
        width: 220px; background: #343a40; color: #fff; padding: 20px;
    }
    .sidebar a {
        color: #fff; text-decoration: none; display: block; padding: 8px 0;
    }
    .sidebar a:hover { background: #495057; border-radius: 5px; }
    .content { flex-grow: 1; padding: 30px; background: #f8f9fa; }
  </style>
</head>
<body>

<div class="sidebar">
    <h4>Menu</h4>
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('users.index') }}">👑 Kelola User</a>
        <a href="{{ route('hewan.index') }}">🐾 Data Hewan</a>
    @else
        <a href="{{ route('hewan.index') }}">🐾 Lihat Hewan</a>
    @endif
    <a href="{{ route('akun') }}">⚙️ Akun Saya</a>

    <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button class="btn btn-danger btn-sm w-100">Logout</button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
