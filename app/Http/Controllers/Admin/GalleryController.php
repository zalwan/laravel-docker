<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleryItems = GalleryItem::query()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15);

        return view('admin.gallery.index', compact('galleryItems'));
    }

    public function create(): View
    {
        return view('admin.gallery.create', [
            'galleryItem' => new GalleryItem(['is_published' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $this->setUploadedImageData($request, $data);

        GalleryItem::create($data);

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Gallery item berhasil dibuat.');
    }

    public function edit(GalleryItem $gallery): View
    {
        return view('admin.gallery.edit', [
            'galleryItem' => $gallery,
        ]);
    }

    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $data = $this->validatedData($request, false);

        if ($request->hasFile('image')) {
            $this->deleteStorageImageIfNeeded($gallery);
            $this->setUploadedImageData($request, $data);
        }

        $gallery->update($data);

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Gallery item berhasil diperbarui.');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        $this->deleteStorageImageIfNeeded($gallery);
        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Gallery item berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, bool $requireImage = true): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
            'is_published' => ['nullable', 'boolean'],
            'image' => [$requireImage ? 'required' : 'nullable', 'file', 'image', 'max:2048'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        unset($data['image']);

        return $data;
    }

    /**
     * @param array<string, mixed> $data
     */
    private function setUploadedImageData(Request $request, array &$data): void
    {
        $image = $request->file('image');

        if (! $image) {
            return;
        }

        $data['image_path'] = 'database/gallery/' . Str::uuid() . '.' . $image->extension();
        $data['image_data'] = base64_encode((string) file_get_contents($image->getRealPath()));
        $data['image_mime'] = $image->getMimeType() ?: $image->getClientMimeType() ?: 'application/octet-stream';
    }

    private function deleteStorageImageIfNeeded(GalleryItem $gallery): void
    {
        if ($gallery->image_data || str_starts_with($gallery->image_path, 'images/')) {
            return;
        }

        Storage::disk('public')->delete($gallery->image_path);
    }
}
