@extends('layouts.app')
@section('title','Projects')

@section('content')
<div class="container my-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold display-5">Featured Portfolios</h2>
    <p class="text-muted lead">A showcase of dynamic AI platforms and applications.</p>
  </div>

  <div class="row g-4 justify-content-center">
    @forelse ($projects as $project)
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 bg-white">
          @if ($project->image)
            <img
              src="{{ asset('images/projects/' . $project->image) }}"
              alt="{{ $project->title }}"
              class="card-img-top"
              style="height: 180px; object-fit: cover;"
              onerror="this.style.display='none'"
            >
          @endif
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="card-title fw-bold mb-0">{{ $project->title }}</h5>
              @if ($project->status)
                <span class="badge rounded-pill
                  @if (strtolower($project->status) === 'selesai') bg-success
                  @else bg-warning text-dark
                  @endif">
                  {{ ucfirst($project->status) }}
                </span>
              @endif
            </div>

            <p class="card-text text-muted">{{ $project->description }}</p>

            @if ($project->teknologi)
              <div class="d-flex flex-wrap gap-1 mt-3">
                @foreach (explode(',', $project->teknologi) as $tech)
                  <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle">
                    {{ trim($tech) }}
                  </span>
                @endforeach
              </div>
            @endif
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center text-muted py-5">
        <p class="mb-0">No projects to show yet.</p>
      </div>
    @endforelse
  </div>
</div>
@endsection
