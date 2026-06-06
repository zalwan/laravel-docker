<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Web Profile</title>
    <meta name="description" content="@yield('meta_description', 'Admin dashboard untuk mengelola konten web profile.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #f6f7fb;
            --admin-surface: #ffffff;
            --admin-border: #e5e7eb;
            --admin-ink: #111827;
            --admin-muted: #6b7280;
            --admin-primary: #0f766e;
            --admin-primary-soft: #ccfbf1;
            --admin-sidebar: #111827;
            --admin-sidebar-muted: #9ca3af;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: var(--admin-bg);
            color: var(--admin-ink);
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .admin-shell {
            display: grid;
            grid-template-columns: 260px minmax(0, 1fr);
            min-height: 100vh;
        }

        .admin-sidebar {
            background: var(--admin-sidebar);
            color: #ffffff;
            padding: 24px 18px;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ffffff;
            text-decoration: none;
            margin-bottom: 32px;
        }

        .admin-brand-mark {
            display: inline-grid;
            width: 38px;
            height: 38px;
            place-items: center;
            border-radius: 8px;
            background: var(--admin-primary);
            font-weight: 700;
        }

        .admin-nav-label {
            color: var(--admin-sidebar-muted);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin: 0 0 10px 10px;
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #d1d5db;
            text-decoration: none;
            padding: 11px 12px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .admin-nav-link:hover,
        .admin-nav-link.active {
            color: #ffffff;
            background: rgba(255, 255, 255, .09);
        }

        button.admin-nav-link {
            background: transparent;
        }

        .admin-main {
            min-width: 0;
            padding: 28px;
        }

        .admin-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 28px;
        }

        .admin-eyebrow {
            color: var(--admin-primary);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .admin-card {
            background: var(--admin-surface);
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .05);
        }

        .admin-stat {
            background: var(--admin-surface);
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            padding: 18px;
        }

        .btn-admin-primary {
            --bs-btn-bg: var(--admin-primary);
            --bs-btn-border-color: var(--admin-primary);
            --bs-btn-hover-bg: #115e59;
            --bs-btn-hover-border-color: #115e59;
            --bs-btn-active-bg: #134e4a;
            --bs-btn-active-border-color: #134e4a;
            color: #ffffff;
        }

        .badge-admin {
            background: var(--admin-primary-soft);
            color: #115e59;
            border: 1px solid #99f6e4;
        }

        @media (max-width: 991.98px) {
            .admin-shell {
                grid-template-columns: 1fr;
            }

            .admin-sidebar {
                position: static;
                padding: 18px;
            }

            .admin-main {
                padding: 20px;
            }

            .admin-topbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a href="{{ route('admin.projects.index') }}" class="admin-brand">
                <span class="admin-brand-mark">A</span>
                <span>
                    <span class="d-block fw-bold">Admin Panel</span>
                    <span class="d-block small text-secondary">Web Profile</span>
                </span>
            </a>

            <p class="admin-nav-label">Konten</p>
            <nav>
                <a href="{{ route('admin.projects.index') }}" class="admin-nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <span>Projects</span>
                    <span class="small">Kelola</span>
                </a>
                <a href="{{ route('projects') }}" class="admin-nav-link">
                    <span>Lihat Website</span>
                    <span class="small">Publik</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="admin-nav-link border-0 w-100 text-start">
                        <span>Logout</span>
                        <span class="small">{{ auth()->user()->name }}</span>
                    </button>
                </form>
            </nav>
        </aside>

        <main class="admin-main">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
