@extends('layouts.app')
@section('title', $article->title . ' - BAWANA')
@section('meta_description', $article->excerpt ?? str($article->body)->limit(150))

@section('content')
<article class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ route('articles.index') }}" class="text-decoration-none mb-4 d-inline-block">Kembali ke Article</a>

            <div class="card soft-card">
                <div class="card-body p-4 p-md-5">
                    <div class="text-muted small mb-3">
                        {{ $article->published_at?->format('d M Y') ?? 'Published' }}
                    </div>
                    <h1 class="fw-bold display-6 mb-3">{{ $article->title }}</h1>

                    @if ($article->excerpt)
                        <p class="lead text-muted mb-4">{{ $article->excerpt }}</p>
                    @endif

                    <div class="fs-5 text-muted" style="white-space: pre-line;">{{ $article->body }}</div>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection
