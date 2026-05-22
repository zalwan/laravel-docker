@csrf

<div class="mb-3">
    <label for="title" class="form-label">Judul Project</label>
    <input
        type="text"
        id="title"
        name="title"
        class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $project->title) }}"
        required
    >
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea
        id="description"
        name="description"
        rows="5"
        class="form-control @error('description') is-invalid @enderror"
    >{{ old('description', $project->description) }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row g-3">
    <div class="col-md-6">
        <label for="teknologi" class="form-label">Teknologi</label>
        <input
            type="text"
            id="teknologi"
            name="teknologi"
            class="form-control @error('teknologi') is-invalid @enderror"
            value="{{ old('teknologi', implode(', ', $project->teknologi ?? [])) }}"
            placeholder="PHP, Laravel, MySQL"
        >
        <div class="form-text">Pisahkan setiap teknologi dengan koma.</div>
        @error('teknologi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="image" class="form-label">Nama File Gambar</label>
        <input
            type="text"
            id="image"
            name="image"
            class="form-control @error('image') is-invalid @enderror"
            value="{{ old('image', $project->image) }}"
            placeholder="erp.png"
        >
        <div class="form-text">File dibaca dari folder public/images/projects.</div>
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mt-3 mb-4">
    <label for="status" class="form-label">Status</label>
    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
        @foreach (['planned' => 'Planned', 'on progress' => 'On Progress', 'selesai' => 'Selesai'] as $value => $label)
            <option value="{{ $value }}" @selected(old('status', $project->status) === $value)>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-admin-primary">{{ $submitLabel }}</button>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
