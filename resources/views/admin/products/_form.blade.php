@csrf

<div class="row g-3">
    <div class="col-md-8">
        <label for="name" class="form-label">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select" required>
            <option value="active" @selected(old('status', $product->status) === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $product->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="slug" class="form-label">Slug</label>
        <input id="slug" type="text" name="slug" value="{{ old('slug', $product->slug) }}" class="form-control" placeholder="auto-generated-if-empty">
        @error('slug') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label for="price" class="form-label">Price</label>
        <input id="price" type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price) }}" class="form-control">
        @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label for="image" class="form-label">Image Filename</label>
        <input id="image" type="text" name="image" value="{{ old('image', $product->image) }}" class="form-control">
        @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" rows="6" class="form-control">{{ old('description', $product->description) }}</textarea>
        @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <div class="form-check">
            <input id="is_featured" type="checkbox" name="is_featured" value="1" class="form-check-input" @checked(old('is_featured', $product->is_featured))>
            <label for="is_featured" class="form-check-label">Featured product</label>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
