@extends('layouts.app')
@section('title', 'Contact')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <h1 class="fw-bold mb-4">Contact</h1>
                    <p class="lead text-muted">We'd love to hear from you. Reach out through any of the channels below.</p>

                    <div class="list-group list-group-flush my-4">
                        <div class="list-group-item py-3">
                            <h6 class="mb-1 text-muted text-uppercase small fw-bold">Email</h6>
                            <p class="mb-0 fw-medium fs-5">hello@example.com</p>
                        </div>
                        <div class="list-group-item py-3">
                            <h6 class="mb-1 text-muted text-uppercase small fw-bold">Phone</h6>
                            <p class="mb-0 fw-medium fs-5">+1 (555) 123-4567</p>
                        </div>
                        <div class="list-group-item py-3 border-bottom-0">
                            <h6 class="mb-1 text-muted text-uppercase small fw-bold">Location</h6>
                            <p class="mb-0 fw-medium fs-5">123 Tech Street, Silicon Valley, CA</p>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="/" class="btn btn-outline-secondary">&larr; Home</a>
                        <a href="/about" class="btn btn-primary">About &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
