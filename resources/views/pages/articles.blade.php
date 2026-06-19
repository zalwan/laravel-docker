@extends('layouts.app')
@section('title', 'Artikel - BAWANA')

@section('content')
<div class="container my-5">
    <div class="section-title text-center mx-auto mb-5">
        <h1 class="fw-bold display-5 mb-3">Artikel</h1>
        <p class="lead text-muted">
            Insight seputar digital learning, employee development, dan implementasi platform pembelajaran perusahaan.
        </p>
    </div>

    <div class="row g-4">
        @forelse ($articles as $article)
            <div class="col-md-6 col-lg-4">
                <div class="card soft-card h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="text-muted small mb-3">
                            {{ $article->published_at?->format('d M Y') ?? 'Published' }}
                        </div>
                        <h2 class="h5 fw-bold mb-3">{{ $article->title }}</h2>
                        <p class="text-muted flex-grow-1">{{ $article->excerpt ?? str($article->body)->limit(140) }}</p>
                        <a href="{{ route('articles.show', $article) }}" class="btn btn-primary mt-3">Baca Artikel</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <p class="mb-0">Belum ada artikel yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $articles->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
