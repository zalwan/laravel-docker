<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin BAWANA')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        :root {
            --admin-ink: #111827;
            --admin-muted: #64748b;
            --admin-sidebar: #0f172a;
            --admin-surface: #ffffff;
            --admin-border: #e5e7eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f6f8fb;
            color: var(--admin-ink);
        }

        .admin-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 272px minmax(0, 1fr);
        }

        .admin-sidebar {
            background: var(--admin-sidebar);
            color: #fff;
            min-height: 100vh;
            position: sticky;
            top: 0;
        }

        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, .72);
            border-radius: 8px;
            padding: .7rem .85rem;
            font-weight: 500;
        }

        .admin-sidebar .nav-link.active,
        .admin-sidebar .nav-link:hover {
            background: rgba(255, 255, 255, .12);
            color: #fff;
        }

        .admin-nav-label {
            color: rgba(255, 255, 255, .42);
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            margin: 1.25rem .85rem .5rem;
            text-transform: uppercase;
        }

        .admin-brand-mark {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #0d6efd;
            color: #fff;
            font-weight: 700;
        }

        .admin-card {
            border: 0;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        }

        .admin-topbar {
            background: rgba(255, 255, 255, .94);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 1010;
        }

        .admin-content {
            max-width: 1180px;
            width: 100%;
        }

        @media (max-width: 991.98px) {
            .admin-shell {
                display: block;
            }

            .admin-sidebar {
                min-height: auto;
                position: static;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar p-4">
            <div class="d-flex align-items-center gap-2 mb-4">
                <span class="admin-brand-mark">B</span>
                <div>
                    <div class="fw-bold">BAWANA</div>
                    <div class="small text-white-50">Admin Panel</div>
                </div>
            </div>

            @include('admin.partials.nav')
        </aside>

        <div class="d-flex flex-column min-vh-100">
            <header class="admin-topbar border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-muted">Login sebagai</div>
                    <div class="fw-semibold">{{ auth()->user()->name }}</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">Website</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm">Logout</button>
                    </form>
                </div>
            </header>

            <main class="p-4">
                <div class="admin-content mx-auto">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
