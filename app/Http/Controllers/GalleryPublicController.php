<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Response;
use Illuminate\View\View;

class GalleryPublicController extends Controller
{
    public function index(): View
    {
        $galleryItems = GalleryItem::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->latest()
            ->paginate(12);

        return view('pages.gallery', compact('galleryItems'));
    }

    public function image(GalleryItem $galleryItem): Response
    {
        abort_unless($galleryItem->image_data, 404);

        return response(base64_decode($galleryItem->image_data), 200, [
            'Content-Type' => $galleryItem->image_mime ?: 'application/octet-stream',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}
