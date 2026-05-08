<?php

namespace App\Http\Controllers;

use App\Models\CompanyContent;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = CompanyContent::where('section', 'service')
            ->orderBy('sort_order')
            ->get();
        $advantages = CompanyContent::where('section', 'advantage')
            ->orderBy('sort_order')
            ->pluck('title');

        return view('pages.services', [
            'services' => $services,
            'advantages' => $advantages,
        ]);
    }
}
