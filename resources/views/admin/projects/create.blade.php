@extends('layouts.admin')
@section('title', 'Tambah Project')

@section('content')
    <div class="admin-topbar">
        <div>
            <div class="admin-eyebrow mb-2">Admin Project</div>
            <h1 class="fw-bold mb-1">Tambah Project</h1>
            <p class="text-muted mb-0">Tambahkan konten baru yang akan tampil di halaman portfolio publik.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="admin-card">
                <div class="p-4">
                    <form action="{{ route('admin.projects.store') }}" method="POST">
                        @include('admin.projects._form', ['submitLabel' => 'Simpan Project'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
