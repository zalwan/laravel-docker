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
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f6fb;
            color: #1f2937;
        }

        .admin-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 260px minmax(0, 1fr);
        }

        .admin-sidebar {
            background: #111827;
            color: #fff;
        }

        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, .72);
            border-radius: 8px;
            padding: .75rem 1rem;
        }

        .admin-sidebar .nav-link.active,
        .admin-sidebar .nav-link:hover {
            background: rgba(255, 255, 255, .1);
            color: #fff;
        }

        .admin-card {
            border: 0;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        }

        @media (max-width: 991.98px) {
            .admin-shell {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar p-4">
            <div class="d-flex align-items-center gap-2 mb-4">
                <span class="badge bg-primary rounded-1 p-2">B</span>
                <div>
                    <div class="fw-bold">BAWANA</div>
                    <div class="small text-white-50">Admin Panel</div>
                </div>
            </div>

            @include('admin.partials.nav')
        </aside>

        <div class="d-flex flex-column min-vh-100">
            <header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-muted">Login sebagai</div>
                    <div class="fw-semibold">{{ auth()->user()->name }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Logout</button>
                </form>
            </header>

            <main class="p-4">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
