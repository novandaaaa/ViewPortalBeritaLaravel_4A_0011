<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f4f5f7; }
        .navbar-brand { font-family: 'Merriweather', serif; letter-spacing: .5px; }
        a { color: inherit; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background:#B3131B;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">KABAR BURUNG</a>
            <div class="ms-auto d-flex gap-2">
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-outline-light btn-sm">Dashboard</a>
                    <form method="POST" action="{{ url('/logout') }}" class="d-inline m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm">Login</a>
                    <a href="{{ url('/register') }}" class="btn btn-light btn-sm">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container my-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('body')
    </div>
</body>
</html>