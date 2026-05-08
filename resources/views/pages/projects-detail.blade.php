@extends('layouts.app')
@section('title', $project->title . ' - Project Detail')
@section('meta_description', $project->description ?? 'Project detail page.')

@section('content')
    <div class="container my-5">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow-sm border-0 bg-white overflow-hidden">
                    @if ($project->image)
                        <img src="{{ asset('images/projects/' . $project->image) }}" alt="{{ $project->title }}"
                            class="card-img-top" style="height: 320px; object-fit: cover;" onerror="this.style.display='none'">
                    @endif

                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                            <div>
                                <p class="text-uppercase text-primary fw-semibold small mb-2">Project Detail</p>
                                <h1 class="fw-bold mb-0">{{ $project->title }}</h1>
                            </div>

                            @if ($project->status)
                                <span
                                    class="badge rounded-pill align-self-start px-3 py-2
                                    @if (strtolower($project->status) === 'selesai') bg-success
                                    @else bg-warning text-dark @endif">
                                    {{ ucfirst($project->status) }}
                                </span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <h5 class="fw-semibold mb-2">Keterangan Project</h5>
                            <p class="text-muted fs-5 mb-0">
                                {{ $project->description ?: 'Belum ada deskripsi detail untuk project ini.' }}
                            </p>
                        </div>

                        @if (!empty($project->teknologi))
                            <div class="mb-4">
                                <h5 class="fw-semibold mb-3">Teknologi yang Digunakan</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($project->teknologi as $tech)
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <p class="text-muted small text-uppercase fw-semibold mb-1">Status</p>
                                    <p class="fw-semibold mb-0">{{ ucfirst($project->status) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <p class="text-muted small text-uppercase fw-semibold mb-1">Jumlah Teknologi</p>
                                    <p class="fw-semibold mb-0">{{ count($project->teknologi ?? []) }} teknologi</p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('projects') }}" class="btn btn-primary">
                            Kembali ke Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
