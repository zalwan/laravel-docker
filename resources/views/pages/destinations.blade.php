@extends('layouts.app')
@section('title', 'Daftar Wisata Alam')

@section('content')
<div class="container my-5">
    <div class="section-title text-center mx-auto mb-5">
        <h1 class="fw-bold display-5 mb-3">Daftar Wisata Alam</h1>
        <p class="lead text-muted">
            Data destinasi berasal dari tabel destinations dan diisi melalui seeder. Setiap kartu memiliki gambar, harga tiket, dan halaman detail.
        </p>
    </div>

    <div class="row g-4">
        @forelse ($destinations as $destination)
            <div class="col-md-4">
                <div class="card soft-card h-100">
                    <img src="{{ asset('assets/images/' . $destination->image) }}" alt="{{ $destination->name }}"
                        class="card-img-top" style="height: 190px; object-fit: cover;" onerror="this.style.display='none'">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                            <h5 class="fw-bold mb-0">{{ $destination->name }}</h5>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle">{{ $destination->region }}</span>
                        </div>
                        <p class="text-muted">{{ \Illuminate\Support\Str::limit($destination->description, 100) }}</p>
                        <p class="fw-semibold mb-3">Rp {{ number_format((float) $destination->ticket_price, 0, ',', '.') }}</p>
                        <a href="{{ route('destinations.show', $destination) }}" class="btn btn-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <p class="mb-0">Belum ada data wisata alam.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $destinations->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
