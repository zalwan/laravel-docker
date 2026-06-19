@csrf

<div class="row g-3">
    <div class="col-md-8">
        <label for="title" class="form-label">Title</label>
        <input id="title" type="text" name="title" value="{{ old('title', $galleryItem->title) }}" class="form-control" required>
        @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="sort_order" class="form-label">Sort Order</label>
        <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $galleryItem->sort_order ?? 0) }}" class="form-control" min="0" max="65535" required>
        @error('sort_order') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-8">
        <label for="image" class="form-label">Image</label>
        <input id="image" type="file" name="image" class="form-control" accept="image/*" @required(! $galleryItem->exists)>
        @if ($galleryItem->image_path)
            <div class="form-text">Current: {{ $galleryItem->image_path }}</div>
        @endif
        @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="alt_text" class="form-label">Alt Text</label>
        <input id="alt_text" type="text" name="alt_text" value="{{ old('alt_text', $galleryItem->alt_text) }}" class="form-control">
        @error('alt_text') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" rows="5" class="form-control">{{ old('description', $galleryItem->description) }}</textarea>
        @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <div class="form-check">
            <input id="is_published" type="checkbox" name="is_published" value="1" class="form-check-input" @checked(old('is_published', $galleryItem->is_published))>
            <label for="is_published" class="form-check-label">Published</label>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
