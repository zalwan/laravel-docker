@extends('layouts.app')
@section('title', 'Daftar Wisata Alam')

@section('content')
<div class="container my-5">
    <div class="section-title text-center mx-auto mb-5">
        <h1 class="fw-bold display-5 mb-3">Daftar Wisata Alam</h1>
        <p class="lead text-muted">
            Pilihan destinasi alam Indonesia lengkap dengan wilayah, deskripsi singkat, harga tiket, gambar, dan halaman detail.
        </p>
    </div>

    <div class="row g-4">
        @forelse ($destinations as $destination)
            <div class="col-md-4">
                <div class="card soft-card destination-card h-100 overflow-hidden">
                    <img src="{{ asset('assets/images/' . $destination->image) }}" alt="{{ $destination->name }}"
                        class="card-img-top" onerror="this.style.display='none'">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                            <h5 class="fw-bold mb-0">{{ $destination->name }}</h5>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle">{{ $destination->region }}</span>
                        </div>
                        <p class="text-muted">{{ \Illuminate\Support\Str::limit($destination->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small">Harga Tiket</span>
                            <span class="fw-semibold">Rp {{ number_format((float) $destination->ticket_price, 0, ',', '.') }}</span>
                        </div>
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
