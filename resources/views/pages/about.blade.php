@extends('layouts.app')
@section('title', 'Tentang Aplikasi UTS')

@section('content')
<div class="container my-5">
    <div class="section-title text-center mx-auto mb-5">
        <h1 class="fw-bold display-5 mb-3">Tentang Aplikasi</h1>
        <p class="lead text-muted">
            Aplikasi ini dibuat untuk memenuhi Ujian Tengah Semester mata kuliah Rekayasa Web dengan tema Daftar Wisata Alam.
        </p>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card soft-card h-100">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-4">Identitas Pengerjaan</h2>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0 d-flex justify-content-between gap-4">
                            <span class="text-muted">Nama</span>
                            <span class="fw-semibold text-end">Rizal Suryawan</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between gap-4">
                            <span class="text-muted">NIM</span>
                            <span class="fw-semibold text-end">241011750067</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between gap-4">
                            <span class="text-muted">Digit Terakhir</span>
                            <span class="fw-semibold text-end">7</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between gap-4">
                            <span class="text-muted">Tema</span>
                            <span class="fw-semibold text-end">Daftar Wisata Alam</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between gap-4">
                            <span class="text-muted">Database</span>
                            <span class="fw-semibold text-end">db_uts_241011750067</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between gap-4">
                            <span class="text-muted">Tabel</span>
                            <span class="fw-semibold text-end">destinations</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card soft-card h-100">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-4">Komponen</h2>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2">Laravel</span>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2">Blade Template</span>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2">Bootstrap</span>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2">Migration</span>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2">Seeder</span>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2">MySQL</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
