@extends('layouts.app')
@section('title', 'BAWANA Services')

@section('content')
<div class="container my-5">
    <div class="section-title text-center mx-auto mb-5">
        <h1 class="fw-bold display-5 mb-3">Produk & Layanan</h1>
        <p class="lead text-muted">Solusi pembelajaran digital untuk membantu perusahaan membangun budaya belajar berkelanjutan.</p>
    </div>

    <div class="row g-4 mb-5">
        @foreach ($services as $service)
            <div class="col-lg-6">
                <div class="card soft-card h-100">
                    <div class="card-body p-5">
                        <h3 class="fw-bold mb-3">{{ $service->title }}</h3>
                        <p class="text-muted">{{ $service->description }}</p>
                        <div class="d-flex flex-wrap gap-2 mt-4">
                            @foreach ($service->items ?? [] as $feature)
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2">{{ $feature }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card soft-card">
        <div class="card-body p-5">
            <h2 class="fw-bold mb-4">Keunggulan Kompetitif</h2>
            <div class="row g-3">
                @foreach ($advantages as $advantage)
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100 bg-light">{{ $advantage }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
