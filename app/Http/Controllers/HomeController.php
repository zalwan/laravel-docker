<?php

namespace App\Http\Controllers;

use App\Models\CompanyContent;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $stats = CompanyContent::where('section', 'stat')
            ->orderBy('sort_order')
            ->get();
        $highlights = CompanyContent::where('section', 'highlight')
            ->orderBy('sort_order')
            ->pluck('title');

        return view('pages.home', [
            'stats' => $stats,
            'highlights' => $highlights,
        ]);
    }
}
