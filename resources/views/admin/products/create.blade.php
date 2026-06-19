@extends('layouts.admin')
@section('title', 'Tambah Product - BAWANA')

@section('content')
<div class="mb-4">
    <p class="text-muted text-uppercase small fw-bold mb-1">Products</p>
    <h1 class="fw-bold mb-0">Tambah Product</h1>
</div>

<div class="card admin-card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @include('admin.products._form')
        </form>
    </div>
</div>
@endsection
