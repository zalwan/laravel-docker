@extends('layouts.admin')
@section('title', 'Admin Dashboard - BAWANA')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
    <div>
        <p class="text-muted text-uppercase small fw-bold mb-1">Admin</p>
        <h1 class="fw-bold mb-0">Dashboard</h1>
    </div>
    <a href="{{ route('contents') }}" class="btn btn-primary align-self-lg-start">Lihat Public Contents</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card admin-card h-100">
            <div class="card-body">
                <div class="text-muted small text-uppercase fw-semibold mb-2">Total Content</div>
                <div class="display-6 fw-bold">{{ $totalContents }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card admin-card h-100">
            <div class="card-body">
                <div class="text-muted small text-uppercase fw-semibold mb-2">Sections</div>
                <div class="display-6 fw-bold">{{ $sectionCounts->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card admin-card h-100">
            <div class="card-body">
                <div class="text-muted small text-uppercase fw-semibold mb-2">Latest Updates</div>
                <div class="display-6 fw-bold">{{ $latestContents->count() }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="card admin-card h-100">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Content by Section</h2>
                <div class="list-group list-group-flush">
                    @forelse ($sectionCounts as $section => $total)
                        <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span class="fw-medium">{{ ucfirst($section) }}</span>
                            <span class="badge bg-primary rounded-pill">{{ $total }}</span>
                        </div>
                    @empty
                        <div class="text-muted py-3">Belum ada content.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card admin-card h-100">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Latest Content</h2>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Section</th>
                                <th class="text-end">Sort</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestContents as $content)
                                <tr>
                                    <td class="fw-medium">{{ $content->title ?? $content->label ?? 'Untitled Content' }}</td>
                                    <td>{{ ucfirst($content->section) }}</td>
                                    <td class="text-end">{{ $content->sort_order }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">Belum ada content.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
