@extends('layouts.app')
@section('title', 'About BAWANA')

@section('content')
<div class="container my-5">
    <div class="section-title text-center mx-auto mb-5">
        <h1 class="fw-bold display-5 mb-3">Tentang BAWANA</h1>
        <p class="lead text-muted">
            BAWANA adalah platform digital learning dan employee development dari PT Meta BAWANA Indonesia, bagian dari Netpolitan Group yang bergerak di industri digital learning sejak 2003.
        </p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="card soft-card h-100">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-4">Identitas Perusahaan</h2>
                    <div class="list-group list-group-flush">
                        @foreach ($identity as $item)
                            <div class="list-group-item px-0 d-flex justify-content-between gap-4">
                                <span class="text-muted">{{ $item->label }}</span>
                                <span class="fw-semibold text-end">{{ $item->value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card soft-card h-100">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-3">Visi</h2>
                    <p class="text-muted mb-4">Menjadi solusi digital learning terdepan dalam mendukung pengembangan talenta dan transformasi pembelajaran perusahaan di Indonesia.</p>

                    <h2 class="fw-bold mb-3">Target Market</h2>
                    <p class="text-muted mb-0">Perusahaan besar, BUMN, institusi keuangan, organisasi pemerintah, dan divisi HR atau Learning Development.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card soft-card mb-4">
        <div class="card-body p-5">
            <h2 class="fw-bold mb-4">Misi</h2>
            <div class="row g-3">
                @foreach ($missions as $mission)
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100 bg-light">{{ $mission }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card soft-card">
        <div class="card-body p-5">
            <h2 class="fw-bold mb-4">Klien & Partner</h2>
            <div class="d-flex flex-wrap gap-2">
                @foreach ($clients as $client)
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2">{{ $client }}</span>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
