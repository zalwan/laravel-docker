@csrf

<div class="row g-3">
    <div class="col-md-4">
        <label for="section" class="form-label">Section</label>
        <select id="section" name="section" class="form-select" required>
            @foreach ($sections as $section)
                <option value="{{ $section }}" @selected(old('section', $content->section) === $section)>{{ ucfirst($section) }}</option>
            @endforeach
        </select>
        @error('section') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="sort_order" class="form-label">Sort Order</label>
        <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $content->sort_order ?? 0) }}" class="form-control" min="0" max="65535" required>
        @error('sort_order') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="image" class="form-label">Image Filename</label>
        <input id="image" type="text" name="image" value="{{ old('image', $content->image) }}" class="form-control" placeholder="elearning.png">
        @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="title" class="form-label">Title</label>
        <input id="title" type="text" name="title" value="{{ old('title', $content->title) }}" class="form-control">
        @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="label" class="form-label">Label</label>
        <input id="label" type="text" name="label" value="{{ old('label', $content->label) }}" class="form-control">
        @error('label') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="value" class="form-label">Value</label>
        <input id="value" type="text" name="value" value="{{ old('value', $content->value) }}" class="form-control">
        @error('value') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" rows="4" class="form-control">{{ old('description', $content->description) }}</textarea>
        @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="items" class="form-label">Items</label>
        <textarea id="items" name="items" rows="5" class="form-control" placeholder="Satu item per baris">{{ old('items', implode(PHP_EOL, $content->items ?? [])) }}</textarea>
        <div class="form-text">Gunakan satu baris untuk setiap item fitur/detail.</div>
        @error('items') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.profile.index') }}" class="btn btn-outline-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
