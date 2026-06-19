@extends('layouts.admin')
@section('title', 'Products - BAWANA')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
    <div>
        <p class="text-muted text-uppercase small fw-bold mb-1">Admin</p>
        <h1 class="fw-bold mb-0">Products</h1>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary align-self-lg-start">Tambah Product</a>
</div>

<div class="card admin-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Product</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <div class="small text-muted">{{ $product->slug }}</div>
                            </td>
                            <td>{{ $product->price ? 'Rp ' . number_format((float) $product->price, 0, ',', '.') : '-' }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($product->status) }}</span></td>
                            <td>{{ $product->is_featured ? 'Yes' : 'No' }}</td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Hapus product ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">Belum ada product.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endsection
