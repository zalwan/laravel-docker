@extends('layouts.admin')
@section('title', 'Edit Gallery - BAWANA')

@section('content')
<div class="mb-4">
    <p class="text-muted text-uppercase small fw-bold mb-1">Gallery</p>
    <h1 class="fw-bold mb-0">Edit Gallery Item</h1>
</div>

<div class="card admin-card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.gallery.update', $galleryItem) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.gallery._form')
        </form>
    </div>
</div>
@endsection
