@extends('layouts.app')
@section('title', 'Contact BAWANA')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card soft-card">
                <div class="card-body p-5">
                    <h1 class="fw-bold mb-4">Contact</h1>
                    <p class="lead text-muted">Hubungi langsung untuk diskusi kebutuhan engineering, digital product, dan implementasi platform.</p>

                    <div class="list-group list-group-flush my-4">
                        @foreach ($contacts as $contact)
                            <div class="list-group-item px-0 py-3 @if ($loop->last) border-bottom-0 @endif">
                                <h6 class="mb-1 text-muted text-uppercase small fw-bold">{{ $contact->label }}</h6>
                                @if ($contact->description)
                                    <a href="{{ $contact->description }}" class="fw-medium text-decoration-none">{{ $contact->value }}</a>
                                @else
                                    <p class="mb-0 fw-medium @if ($contact->label === 'Nama') fs-5 @endif">{{ $contact->value }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Lihat Product</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Kembali ke Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
