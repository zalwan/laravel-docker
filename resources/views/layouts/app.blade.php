<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UTS Wisata Alam')</title>
    <meta name="description" content="@yield('meta_description', 'Aplikasi UTS Rekayasa Web - Daftar Wisata Alam.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('Bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f7f2;
            color: #1f2933;
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
            border-radius: 8px;
            box-shadow: 0 14px 34px rgba(20, 83, 45, .11);
        }

        .hero-band {
            background: linear-gradient(135deg, #0f5132 0%, #146c43 48%, #0d6efd 100%);
            color: #fff;
            overflow: hidden;
        }

        .hero-band .text-muted {
            color: rgba(255, 255, 255, .78) !important;
        }

        .hero-media {
            height: 430px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .25);
        }

        .destination-card img {
            height: 210px;
            object-fit: cover;
        }

        .destination-card {
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .destination-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 42px rgba(20, 83, 45, .16);
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #198754;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .btn-primary {
            background-color: #198754;
            border-color: #198754;
        }

        .btn-primary:hover {
            background-color: #146c43;
            border-color: #146c43;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand fw-bold d-flex align-items-center gap-2">
                <span class="brand-mark">W</span>
                Wisata Alam
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
                        <a class="nav-link {{ request()->routeIs('destinations*') ? 'active' : '' }}" href="{{ route('destinations') }}">Destinations</a>
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
            <span class="fw-semibold">UTS Rekayasa Web</span> &middot; NIM 241011750067 &middot; Tema Daftar Wisata Alam
        </div>
    </footer>

    <script src="{{ asset('Bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
