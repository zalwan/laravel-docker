@extends('layouts.app')
@section('title', 'UTS 241011750067 - Daftar Wisata Alam')

@section('content')
<section class="bg-white border-bottom">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2 mb-3">
                    Rekayasa Web - UTS
                </span>
                <h1 class="display-4 fw-bold mb-4">Daftar Wisata Alam Indonesia</h1>
                <p class="lead text-muted mb-4">
                    Aplikasi frontend Laravel dengan Blade Template dan Bootstrap untuk menampilkan data wisata alam dari database MySQL menggunakan migration dan seeder.
                </p>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="badge bg-secondary bg-opacity-10 text-secondary border px-3 py-2">NIM 241011750067</span>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary border px-3 py-2">Digit akhir 7</span>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary border px-3 py-2">{{ $destinationCount }} destinasi</span>
                </div>
                <a href="{{ route('destinations') }}" class="btn btn-primary btn-lg px-4">Lihat Daftar Wisata</a>
            </div>
            <div class="col-lg-5">
                <div class="card soft-card">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Ketentuan Soal</h5>
                        <ul class="text-muted mb-0">
                            <li>Tema: Daftar Wisata Alam</li>
                            <li>Tabel: destinations</li>
                            <li>Kolom: name, region, description, image, ticket_price</li>
                            <li>Gambar tersimpan di public/assets/images</li>
                        </ul>
                    </div>
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
                <div class="card soft-card h-100">
                    <img src="{{ asset('assets/images/' . $destination->image) }}" alt="{{ $destination->name }}"
                        class="card-img-top" style="height: 180px; object-fit: cover;" onerror="this.style.display='none'">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-2">{{ $destination->name }}</h5>
                        <p class="text-muted mb-3">{{ $destination->region }}</p>
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
