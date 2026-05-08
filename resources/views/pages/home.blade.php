@extends('layouts.app')
@section('title', 'UTS 241011750067 - Daftar Wisata Alam')

@section('content')
<section class="hero-band">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge bg-white bg-opacity-25 text-white border border-light-subtle px-3 py-2 mb-3">
                    Rekayasa Web - UTS
                </span>
                <h1 class="display-4 fw-bold mb-4">Jelajahi wisata alam terbaik Indonesia.</h1>
                <p class="lead text-muted mb-4">
                    Katalog destinasi wisata alam berbasis Laravel, Blade Template, Bootstrap, migration, seeder, dan database MySQL khusus UTS.
                </p>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="badge bg-white bg-opacity-25 text-white border px-3 py-2">NIM 241011750067</span>
                    <span class="badge bg-white bg-opacity-25 text-white border px-3 py-2">Digit akhir 7</span>
                    <span class="badge bg-white bg-opacity-25 text-white border px-3 py-2">Tema Wisata Alam</span>
                </div>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('destinations') }}" class="btn btn-light btn-lg px-4">Lihat Daftar Wisata</a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg px-4">Tentang Aplikasi</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/images/hero-wisata-alam.png') }}" alt="Panorama wisata alam Indonesia" class="hero-media w-100">
            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card soft-card h-100">
                <div class="card-body p-4 text-center">
                    <h2 class="fw-bold text-success mb-1">{{ $destinationCount }}</h2>
                    <p class="text-muted mb-0">Destinasi dari Seeder</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card soft-card h-100">
                <div class="card-body p-4 text-center">
                    <h2 class="fw-bold text-success mb-1">{{ $regionCount }}</h2>
                    <p class="text-muted mb-0">Wilayah Indonesia</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card soft-card h-100">
                <div class="card-body p-4 text-center">
                    <h2 class="fw-bold text-success mb-1">Rp {{ number_format((float) $lowestTicketPrice, 0, ',', '.') }}</h2>
                    <p class="text-muted mb-0">Tiket Termurah</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <div class="section-title text-center mx-auto mb-5">
        <h2 class="fw-bold display-6 mb-3">Wisata Pilihan</h2>
        <p class="text-muted">Tiga destinasi dengan harga tiket paling terjangkau dari data seeder.</p>
    </div>

    <div class="row g-4">
        @forelse ($featuredDestinations as $destination)
            <div class="col-md-4">
                <div class="card soft-card destination-card h-100 overflow-hidden">
                    <img src="{{ asset('assets/images/' . $destination->image) }}" alt="{{ $destination->name }}"
                        class="card-img-top" onerror="this.style.display='none'">
                    <div class="card-body p-4">
                        <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle mb-3">{{ $destination->region }}</span>
                        <h5 class="fw-bold mb-2">{{ $destination->name }}</h5>
                        <p class="text-muted mb-3">Rp {{ number_format((float) $destination->ticket_price, 0, ',', '.') }}</p>
                        <a href="{{ route('destinations.show', $destination) }}" class="btn btn-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">Belum ada data destinasi.</div>
        @endforelse
    </div>
</section>
@endsection
