@extends('layouts.admin')
@section('title', 'Articles - BAWANA')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
    <div>
        <p class="text-muted text-uppercase small fw-bold mb-1">Admin</p>
        <h1 class="fw-bold mb-0">Articles</h1>
    </div>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary align-self-lg-start">Tambah Article</a>
</div>

<div class="card admin-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Article</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-semibold">{{ $article->title }}</div>
                                <div class="small text-muted">{{ $article->slug }}</div>
                            </td>
                            <td><span class="badge bg-secondary">{{ ucfirst($article->status) }}</span></td>
                            <td>{{ $article->published_at?->format('d M Y H:i') ?? '-' }}</td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Hapus article ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">Belum ada article.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $articles->links('pagination::bootstrap-5') }}
</div>
@endsection
