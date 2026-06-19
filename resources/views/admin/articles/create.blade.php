@extends('layouts.admin')
@section('title', 'Tambah Article - BAWANA')

@section('content')
<div class="mb-4">
    <p class="text-muted text-uppercase small fw-bold mb-1">Articles</p>
    <h1 class="fw-bold mb-0">Tambah Article</h1>
</div>

<div class="card admin-card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.articles.store') }}">
            @include('admin.articles._form')
        </form>
    </div>
</div>
@endsection
