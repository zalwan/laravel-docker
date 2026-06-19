<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductPublicController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->where('status', 'active')
            ->orderByDesc('is_featured')
            ->latest()
            ->paginate(9);

        return view('pages.products', compact('products'));
    }

    public function show(Product $product): View
    {
        abort_unless($product->status === 'active', 404);

        return view('pages.product-detail', compact('product'));
    }
}
