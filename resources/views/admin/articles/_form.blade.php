@csrf

<div class="row g-3">
    <div class="col-md-8">
        <label for="title" class="form-label">Title</label>
        <input id="title" type="text" name="title" value="{{ old('title', $article->title) }}" class="form-control" required>
        @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select" required>
            <option value="draft" @selected(old('status', $article->status) === 'draft')>Draft</option>
            <option value="published" @selected(old('status', $article->status) === 'published')>Published</option>
        </select>
        @error('status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-8">
        <label for="slug" class="form-label">Slug</label>
        <input id="slug" type="text" name="slug" value="{{ old('slug', $article->slug) }}" class="form-control" placeholder="auto-generated-if-empty">
        @error('slug') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="published_at" class="form-label">Published At</label>
        <input id="published_at" type="datetime-local" name="published_at" value="{{ old('published_at', optional($article->published_at)->format('Y-m-d\TH:i')) }}" class="form-control">
        @error('published_at') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="excerpt" class="form-label">Excerpt</label>
        <textarea id="excerpt" name="excerpt" rows="3" class="form-control">{{ old('excerpt', $article->excerpt) }}</textarea>
        @error('excerpt') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="body" class="form-label">Body</label>
        <textarea id="body" name="body" rows="10" class="form-control" required>{{ old('body', $article->body) }}</textarea>
        @error('body') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
