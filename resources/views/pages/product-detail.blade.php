@extends('layouts.app')
@section('title', $product->name . ' - BAWANA')
@section('meta_description', $product->description ?? 'Product BAWANA')

@section('content')
<div class="container my-5">
    <a href="{{ route('products.index') }}" class="text-decoration-none mb-4 d-inline-block">Kembali ke Product</a>

    <div class="row g-4 align-items-start">
        <div class="col-lg-6">
            <div class="card soft-card overflow-hidden">
                @if ($product->image)
                    <img src="{{ asset('images/projects/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid w-100" style="height: 420px; object-fit: cover;" onerror="this.style.display='none'">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 320px;">Image belum tersedia</div>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card soft-card">
                <div class="card-body p-4 p-md-5">
                    @if ($product->is_featured)
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2 mb-3">Product Unggulan</span>
                    @endif
                    <h1 class="fw-bold display-6 mb-3">{{ $product->name }}</h1>
                    @if ($product->price)
                        <p class="h4 text-primary fw-bold mb-4">Rp {{ number_format((float) $product->price, 0, ',', '.') }}</p>
                    @endif
                    <p class="lead text-muted mb-0">{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
