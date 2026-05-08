@extends('layouts.app')
@section('title', 'Projects Detail')

@section('content')
    {{-- <style>
</style> --}}


    <div class="container my-5">
        {{-- <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Featured Portfolios</h2>
            <p class="text-muted lead">A showcase of dynamic AI platforms and applications.</p>
        </div> --}}

        <div class="row g-4 justify-content-center">
            {{-- loop data --}}

            <div class="col-md-8">
                <div class="card h-fit shadow-sm border-0 bg-white">
                    @if ($project->image)
                        <img src="{{ asset('images/projects/' . $project->image) }}" alt="{{ $project->title }}"
                            class="card-img-top" style="height: 180px; object-fit: cover;" onerror="this.style.display='none'">
                    @endif
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold mb-0">{{ $project->title }}</h5>
                            @if ($project->status)
                                <span
                                    class="badge rounded-pill
                  @if (strtolower($project->status) === 'selesai') bg-success
                  @else bg-warning text-dark @endif">
                                    {{ ucfirst($project->status) }}
                                </span>
                            @endif


                        </div>

                        <p class="card-text text-muted">{{ $project->description }}</p>

                        @if (!empty($project->teknologi))
                            <div class="d-flex flex-wrap gap-1 mt-3">
                                @foreach ($project->teknologi as $tech)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('projects') }}" class="mt-3 btn btn-primary w-100">
                            kembali</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
