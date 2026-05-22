@extends('layouts.admin')
@section('title', 'Admin Projects')

@section('content')
    <div class="admin-topbar">
        <div>
            <div class="admin-eyebrow mb-2">Admin</div>
            <h1 class="fw-bold mb-1">Kelola Projects</h1>
            <p class="text-muted mb-0">Atur daftar portfolio, status pengerjaan, teknologi, dan gambar project.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-admin-primary">Tambah Project</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="admin-stat">
                <div class="text-muted small mb-1">Total Project</div>
                <div class="fs-3 fw-bold">{{ $projects->total() }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-stat">
                <div class="text-muted small mb-1">Tampil Per Halaman</div>
                <div class="fs-3 fw-bold">{{ $projects->count() }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-stat">
                <div class="text-muted small mb-1">Halaman</div>
                <div class="fs-3 fw-bold">{{ $projects->currentPage() }} / {{ $projects->lastPage() }}</div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Project</th>
                        <th>Teknologi</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $project->title }}</div>
                                <div class="text-muted small">{{ \Illuminate\Support\Str::limit($project->description, 90) }}</div>
                            </td>
                            <td>
                                @forelse ($project->teknologi ?? [] as $tech)
                                    <span class="badge badge-admin">
                                        {{ $tech }}
                                    </span>
                                @empty
                                    <span class="text-muted small">-</span>
                                @endforelse
                            </td>
                            <td>
                                <span
                                    class="badge rounded-pill
                                    @if (strtolower($project->status) === 'selesai') bg-success
                                    @elseif (strtolower($project->status) === 'planned') bg-secondary
                                    @else bg-warning text-dark @endif"
                                >
                                    {{ ucfirst($project->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-outline-secondary">
                                        Lihat
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                                    <form
                                        action="{{ route('admin.projects.destroy', $project) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus project ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">Belum ada project.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
@endsection
