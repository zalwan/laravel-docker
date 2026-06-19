@extends('layouts.admin')
@section('title', 'Tambah Gallery - BAWANA')

@section('content')
<div class="mb-4">
    <p class="text-muted text-uppercase small fw-bold mb-1">Gallery</p>
    <h1 class="fw-bold mb-0">Tambah Gallery Item</h1>
</div>

<div class="card admin-card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
            @include('admin.gallery._form')
        </form>
    </div>
</div>
@endsection
