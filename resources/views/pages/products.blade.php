@extends('layouts.app')
@section('title', 'Product - BAWANA')

@section('content')
<div class="container my-5">
    <div class="section-title text-center mx-auto mb-5">
        <h1 class="fw-bold display-5 mb-3">Product</h1>
        <p class="lead text-muted">
            Rangkaian product pembelajaran digital BAWANA untuk platform, konten, simulasi, dan pendampingan implementasi.
        </p>
    </div>

    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-md-6 col-lg-4">
                <div class="card soft-card h-100 overflow-hidden">
                    @if ($product->image)
                        <img src="{{ asset('images/projects/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top" style="height: 190px; object-fit: cover;" onerror="this.style.display='none'">
                    @endif
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2">{{ ucfirst($product->status) }}</span>
                            @if ($product->is_featured)
                                <span class="badge bg-warning text-dark px-3 py-2">Featured</span>
                            @endif
                        </div>
                        <h2 class="h5 fw-bold mb-3">{{ $product->name }}</h2>
                        <p class="text-muted flex-grow-1">{{ str($product->description)->limit(130) }}</p>
                        @if ($product->price)
                            <p class="fw-semibold mb-3">Rp {{ number_format((float) $product->price, 0, ',', '.') }}</p>
                        @endif
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary mt-auto">Lihat Product</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <p class="mb-0">Belum ada product yang aktif.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
