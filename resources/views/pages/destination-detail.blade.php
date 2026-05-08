@extends('layouts.app')
@section('title', $destination->name . ' - Detail Wisata')

@section('content')
<div class="container my-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-9">
            <div class="card soft-card overflow-hidden">
                <img src="{{ asset('assets/images/' . $destination->image) }}" alt="{{ $destination->name }}"
                    class="card-img-top" style="height: 360px; object-fit: cover;" onerror="this.style.display='none'">

                <div class="card-body p-4 p-md-5">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                        <div>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2 mb-3">
                                {{ $destination->region }}
                            </span>
                            <h1 class="fw-bold mb-0">{{ $destination->name }}</h1>
                        </div>
                        <div class="align-self-start text-md-end">
                            <p class="text-muted small text-uppercase fw-semibold mb-1">Harga Tiket</p>
                            <p class="fs-4 fw-bold text-primary mb-0">Rp {{ number_format((float) $destination->ticket_price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold mb-2">Deskripsi Wisata</h5>
                        <p class="text-muted fs-5 mb-0">{{ $destination->description }}</p>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted small text-uppercase fw-semibold mb-1">Nama Destinasi</p>
                                <p class="fw-semibold mb-0">{{ $destination->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted small text-uppercase fw-semibold mb-1">Nama File Gambar</p>
                                <p class="fw-semibold mb-0">{{ $destination->image }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('destinations') }}" class="btn btn-primary">Kembali ke Daftar Wisata</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
