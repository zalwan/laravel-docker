@extends('layouts.app')
@section('title', 'Gallery - BAWANA')

@section('content')
<div class="container my-5">
    <div class="section-title text-center mx-auto mb-5">
        <h1 class="fw-bold display-5 mb-3">Gallery</h1>
        <p class="lead text-muted">
            Dokumentasi visual aktivitas, produk, dan pengalaman digital learning BAWANA.
        </p>
    </div>

    <div class="row g-4">
        @forelse ($galleryItems as $galleryItem)
            @php
                $imageUrl = str_starts_with($galleryItem->image_path, 'images/')
                    ? asset($galleryItem->image_path)
                    : asset('storage/' . $galleryItem->image_path);
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card soft-card h-100 overflow-hidden">
                    <img src="{{ $imageUrl }}"
                        alt="{{ $galleryItem->alt_text ?? $galleryItem->title }}"
                        class="card-img-top"
                        style="height: 240px; object-fit: cover;"
                        onerror="this.closest('.card').querySelector('.gallery-image-fallback').classList.remove('d-none'); this.style.display='none';">
                    <div class="gallery-image-fallback d-none bg-light text-muted text-center py-5">
                        Image belum tersedia
                    </div>
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold mb-2">{{ $galleryItem->title }}</h2>
                        @if ($galleryItem->description)
                            <p class="text-muted mb-0">{{ $galleryItem->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <p class="mb-0">Belum ada gallery yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $galleryItems->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
