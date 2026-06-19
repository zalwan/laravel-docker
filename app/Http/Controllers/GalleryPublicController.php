<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
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
}
