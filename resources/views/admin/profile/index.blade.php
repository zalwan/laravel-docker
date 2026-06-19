@extends('layouts.admin')
@section('title', 'Company Profile - BAWANA')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
    <div>
        <p class="text-muted text-uppercase small fw-bold mb-1">Admin</p>
        <h1 class="fw-bold mb-0">Company Profile Content</h1>
    </div>
    <a href="{{ route('admin.profile.create') }}" class="btn btn-primary align-self-lg-start">Tambah Content</a>
</div>

<div class="card admin-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Content</th>
                        <th>Section</th>
                        <th>Value</th>
                        <th class="text-end">Sort</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contents as $content)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-semibold">{{ $content->title ?? $content->label ?? 'Untitled Content' }}</div>
                                @if ($content->description)
                                    <div class="small text-muted">{{ str($content->description)->limit(90) }}</div>
                                @endif
                            </td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ ucfirst($content->section) }}</span></td>
                            <td>{{ $content->value ?? '-' }}</td>
                            <td class="text-end">{{ $content->sort_order }}</td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.profile.edit', $content) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.profile.destroy', $content) }}" onsubmit="return confirm('Hapus content ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">Belum ada content.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $contents->links('pagination::bootstrap-5') }}
</div>
@endsection
