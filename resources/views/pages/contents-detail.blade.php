@extends('layouts.app')
@section('title', ($content->title ?? $content->label ?? 'Content Detail') . ' - BAWANA')

@section('content')
<div class="container my-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-9">
            <div class="card soft-card overflow-hidden">
                @if ($content->image)
                    <img src="{{ asset('images/projects/' . $content->image) }}" alt="{{ $content->title ?? $content->label ?? 'Dynamic content image' }}"
                        class="card-img-top" style="height: 320px; object-fit: cover;" onerror="this.style.display='none'">
                @endif

                <div class="card-body p-4 p-md-5">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                        <div>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2 mb-3">
                                {{ ucfirst($content->section) }}
                            </span>
                            <h1 class="fw-bold mb-0">{{ $content->title ?? $content->label ?? 'Untitled Content' }}</h1>
                        </div>
                        <span class="text-muted align-self-start">Sort #{{ $content->sort_order }}</span>
                    </div>

                    @if ($content->value)
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-2">Value</h5>
                            <p class="text-muted fs-5 mb-0">{{ $content->value }}</p>
                        </div>
                    @endif

                    @if ($content->description)
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-2">Deskripsi</h5>
                            <p class="text-muted fs-5 mb-0">{{ $content->description }}</p>
                        </div>
                    @endif

                    @if (!empty($content->items))
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-3">Detail Items</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($content->items as $item)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2">{{ $item }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted small text-uppercase fw-semibold mb-1">Section</p>
                                <p class="fw-semibold mb-0">{{ ucfirst($content->section) }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted small text-uppercase fw-semibold mb-1">Image</p>
                                <p class="fw-semibold mb-0">{{ $content->image ?? 'No image' }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('contents') }}" class="btn btn-primary">
                        Kembali ke Contents
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
