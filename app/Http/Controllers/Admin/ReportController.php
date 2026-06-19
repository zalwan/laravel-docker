<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CompanyContent;
use App\Models\GalleryItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function export(): Response
    {
        $data = [
            'generatedAt' => now(),
            'summary' => [
                'company_contents' => CompanyContent::count(),
                'articles' => Article::count(),
                'published_articles' => Article::where('status', 'published')->count(),
                'products' => Product::count(),
                'active_products' => Product::where('status', 'active')->count(),
                'gallery_items' => GalleryItem::count(),
                'published_gallery_items' => GalleryItem::where('is_published', true)->count(),
            ],
            'latestArticles' => Article::latest()->limit(5)->get(),
            'latestProducts' => Product::latest()->limit(5)->get(),
            'latestGalleryItems' => GalleryItem::latest()->limit(5)->get(),
        ];

        return Pdf::loadView('admin.reports.project-summary', $data)
            ->setPaper('a4')
            ->download('bawana-project-report.pdf');
    }
}
