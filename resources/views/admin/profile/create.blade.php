@extends('layouts.admin')
@section('title', 'Tambah Company Profile - BAWANA')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted text-uppercase small fw-bold mb-1">Company Profile</p>
        <h1 class="fw-bold mb-0">Tambah Content</h1>
    </div>
</div>

<div class="card admin-card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.profile.store') }}">
            @include('admin.profile._form')
        </form>
    </div>
</div>
@endsection
