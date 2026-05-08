<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BAWANA')</title>
    <meta name="description" content="@yield('meta_description', 'BAWANA adalah platform digital learning dan employee development berbasis AI untuk perusahaan.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1f2937;
        }

        .navbar-brand {
            letter-spacing: .02em;
        }

        .section-title {
            max-width: 720px;
        }

        .hero-image {
            height: 420px;
            object-fit: cover;
        }

        .soft-card {
            border: 0;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #0d6efd;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand fw-bold d-flex align-items-center gap-2">
                <span class="brand-mark">B</span>
                BAWANA
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="py-4 bg-dark text-center text-white">
        <div class="container">
            <span class="fw-semibold">BAWANA</span> &middot; Digital Learning & Employee Development
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
