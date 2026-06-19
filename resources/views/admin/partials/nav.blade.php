<nav class="nav flex-column gap-1">
    <div class="admin-nav-label">Overview</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('admin.reports.export') }}" class="nav-link">PDF Report</a>

    <div class="admin-nav-label">Content</div>
    <a href="{{ route('admin.profile.index') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">Company Profile</a>
    <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">Articles</a>
    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a>
    <a href="{{ route('admin.gallery.index') }}" class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">Gallery</a>

    <div class="admin-nav-label">Public</div>
    <a href="{{ route('home') }}" class="nav-link">Lihat Website</a>
</nav>
