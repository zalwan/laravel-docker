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
        :root {
            --bawana-primary: #0d6efd;
            --bawana-ink: #111827;
            --bawana-muted: #64748b;
            --bawana-surface: #ffffff;
            --bawana-border: #e5e7eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1f2937;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .site-navbar {
            position: sticky;
            top: 0;
            z-index: 1020;
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, .94);
        }

        .navbar-brand {
            letter-spacing: .02em;
        }

        .navbar .nav-link {
            color: var(--bawana-muted);
            font-weight: 500;
            border-radius: 8px;
            padding: .5rem .75rem;
        }

        .navbar .nav-link.active,
        .navbar .nav-link:hover {
            color: var(--bawana-primary);
            background: rgba(13, 110, 253, .08);
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

        .admin-entry-btn {
            border-radius: 8px;
            font-weight: 600;
            padding-inline: 1rem;
        }

        .site-footer {
            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        @media (max-width: 991.98px) {
            .public-nav-actions {
                align-items: stretch;
                padding-top: 1rem;
            }

            .admin-entry-btn {
                width: 100%;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg border-bottom site-navbar">
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
                        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}" href="{{ route('articles.index') }}">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery.index') ? 'active' : '' }}" href="{{ route('gallery.index') }}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

                <div class="public-nav-actions d-flex ms-lg-3">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary admin-entry-btn">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="py-4 bg-dark text-center text-white site-footer">
        <div class="container">
            <span class="fw-semibold">BAWANA</span> &middot; Digital Learning & Employee Development
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
