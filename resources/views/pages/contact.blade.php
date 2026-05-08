@extends('layouts.app')
@section('title', 'Contact BAWANA')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card soft-card">
                <div class="card-body p-5">
                    <h1 class="fw-bold mb-4">Kontak</h1>
                    <p class="lead text-muted">Hubungi BAWANA untuk diskusi kebutuhan digital learning dan employee development perusahaan.</p>

                    <div class="list-group list-group-flush my-4">
                        <div class="list-group-item px-0 py-3">
                            <h6 class="mb-1 text-muted text-uppercase small fw-bold">Perusahaan</h6>
                            <p class="mb-0 fw-medium fs-5">PT Meta BAWANA Indonesia</p>
                        </div>
                        <div class="list-group-item px-0 py-3">
                            <h6 class="mb-1 text-muted text-uppercase small fw-bold">Alamat</h6>
                            <p class="mb-0 fw-medium">Ruko Golden Boulevard C30-31, Bumi Serpong Damai, Tangerang 15320, Indonesia</p>
                        </div>
                        <div class="list-group-item px-0 py-3">
                            <h6 class="mb-1 text-muted text-uppercase small fw-bold">Website</h6>
                            <a href="https://bawana.com" class="fw-medium fs-5 text-decoration-none">bawana.com</a>
                        </div>
                        <div class="list-group-item px-0 py-3 border-bottom-0">
                            <h6 class="mb-1 text-muted text-uppercase small fw-bold">LinkedIn</h6>
                            <a href="https://id.linkedin.com/company/meta-bawana-indonesia" class="fw-medium text-decoration-none">PT Meta Bawana Indonesia</a>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('services') }}" class="btn btn-primary">Lihat Services</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Kembali ke Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
