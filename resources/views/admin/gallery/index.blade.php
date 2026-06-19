@extends('layouts.admin')
@section('title', 'Gallery - BAWANA')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
    <div>
        <p class="text-muted text-uppercase small fw-bold mb-1">Admin</p>
        <h1 class="fw-bold mb-0">Gallery</h1>
    </div>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary align-self-lg-start">Tambah Gallery Item</a>
</div>

<div class="card admin-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th class="text-end">Sort</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($galleryItems as $galleryItem)
                        <tr>
                            <td class="ps-4" style="width: 110px;">
                                <img src="{{ asset('storage/' . $galleryItem->image_path) }}" alt="{{ $galleryItem->alt_text ?? $galleryItem->title }}" class="rounded object-fit-cover" width="72" height="54">
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $galleryItem->title }}</div>
                                <div class="small text-muted">{{ $galleryItem->image_path }}</div>
                            </td>
                            <td>{{ $galleryItem->is_published ? 'Published' : 'Draft' }}</td>
                            <td class="text-end">{{ $galleryItem->sort_order }}</td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.gallery.edit', $galleryItem) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.gallery.destroy', $galleryItem) }}" onsubmit="return confirm('Hapus gallery item ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">Belum ada gallery item.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $galleryItems->links('pagination::bootstrap-5') }}
</div>
@endsection
