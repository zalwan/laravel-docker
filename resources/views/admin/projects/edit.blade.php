@extends('layouts.admin')
@section('title', 'Edit Project')

@section('content')
    <div class="admin-topbar">
        <div>
            <div class="admin-eyebrow mb-2">Admin Project</div>
            <h1 class="fw-bold mb-1">Edit Project</h1>
            <p class="text-muted mb-0">Perbarui konten project sebelum ditampilkan ke pengunjung.</p>
        </div>
        <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-secondary">Preview</a>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="admin-card">
                <div class="p-4">
                    <form action="{{ route('admin.projects.update', $project) }}" method="POST">
                        @method('PUT')
                        @include('admin.projects._form', ['submitLabel' => 'Update Project'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
