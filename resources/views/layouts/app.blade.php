<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <meta name="description" content="@yield('meta_description', 'A Laravel application running on Docker.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary justify-content-between">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand">Web profile</a>


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projects*') ? 'active' : '' }}" href="{{ route('projects') }}">Project</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
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

    <footer class="mb-0 py-3 bg-dark text-center text-white ">
        Laravel {{ app()->version() }} &middot; PHP {{ PHP_MAJOR_VERSION }}.{{ PHP_MINOR_VERSION }}
    </footer>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
