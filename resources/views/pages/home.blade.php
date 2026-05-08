@extends('layouts.app')
@section('title', 'BAWANA - Digital Learning Platform')

@section('content')
<section class="bg-white">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2 mb-3">Corporate Learning Platform</span>
                <h1 class="display-4 fw-bold mb-4">Digital learning untuk pengembangan talenta perusahaan.</h1>
                <p class="lead text-muted mb-4">
                    BAWANA membantu perusahaan meningkatkan kompetensi karyawan melalui Learning Experience Platform berbasis AI, konten pelatihan digital, dan dukungan implementasi pembelajaran.
                </p>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    @foreach ($highlights as $highlight)
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border px-3 py-2">{{ $highlight }}</span>
                    @endforeach
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('services') }}" class="btn btn-primary btn-lg px-4">Explore Services</a>
                    <a href="{{ route('about') }}" class="btn btn-outline-secondary btn-lg px-4">Company Profile</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/projects/elearning.png') }}" alt="Digital learning platform" class="img-fluid rounded shadow hero-image w-100">
            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <div class="row g-4">
        @foreach ($stats as $stat)
            <div class="col-md-3 col-6">
                <div class="card soft-card h-100">
                    <div class="card-body p-4 text-center">
                        <h2 class="fw-bold text-primary mb-1">{{ $stat->value }}</h2>
                        <p class="text-muted mb-0">{{ $stat->label }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="container my-5">
    <div class="card soft-card">
        <div class="card-body p-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7">
                    <h2 class="fw-bold mb-3">3-in-1 Digital Learning Solution</h2>
                    <p class="text-muted mb-0">
                        BAWANA menggabungkan learning platform, learning content, dan customer success service dalam satu ekosistem pembelajaran digital untuk mempercepat upskilling dan reskilling karyawan.
                    </p>
                </div>
                <div class="col-lg-5">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="p-3 border rounded bg-light">Learning Platform</div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 border rounded bg-light">Learning Content</div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 border rounded bg-light">Customer Success</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
