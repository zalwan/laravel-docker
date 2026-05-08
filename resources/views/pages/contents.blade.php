@extends('layouts.app')
@section('title', 'Dynamic Contents - BAWANA')

@section('content')
<div class="container my-5">
    <div class="section-title text-center mx-auto mb-5">
        <h1 class="fw-bold display-5 mb-3">Dynamic Contents</h1>
        <p class="lead text-muted">
            Seluruh konten company profile BAWANA di halaman ini berasal dari tabel company_contents dan ditampilkan 10 item per halaman.
        </p>
    </div>

    <div class="row g-4">
        @forelse ($contents as $content)
            <div class="col-md-6">
                <div class="card soft-card h-100">
                    @if ($content->image)
                        <img src="{{ asset('images/projects/' . $content->image) }}" alt="{{ $content->title ?? $content->label ?? 'Dynamic content image' }}"
                            class="card-img-top" style="height: 180px; object-fit: cover;" onerror="this.style.display='none'">
                    @endif
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2">
                                {{ ucfirst($content->section) }}
                            </span>
                            <span class="text-muted small">#{{ $content->sort_order }}</span>
                        </div>

                        <h5 class="fw-bold mb-2">{{ $content->title ?? $content->label ?? 'Untitled Content' }}</h5>

                        @if ($content->value)
                            <p class="fw-semibold mb-2">{{ $content->value }}</p>
                        @endif

                        @if ($content->description)
                            <p class="text-muted mb-3">{{ $content->description }}</p>
                        @endif

                        @if (!empty($content->items))
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach ($content->items as $item)
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border px-3 py-2">{{ $item }}</span>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('contents.show', $content) }}" class="btn btn-primary w-100 mt-2">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <p class="mb-0">No dynamic content available.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $contents->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
