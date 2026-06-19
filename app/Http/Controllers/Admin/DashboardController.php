<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyContent;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $sectionCounts = CompanyContent::query()
            ->selectRaw('section, count(*) as total')
            ->groupBy('section')
            ->orderBy('section')
            ->pluck('total', 'section');

        $latestContents = CompanyContent::query()
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'totalContents' => CompanyContent::count(),
            'sectionCounts' => $sectionCounts,
            'latestContents' => $latestContents,
        ]);
    }
}
