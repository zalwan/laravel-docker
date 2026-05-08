<?php

namespace App\Http\Controllers;

use App\Models\CompanyContent;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $identity = CompanyContent::where('section', 'identity')
            ->orderBy('sort_order')
            ->get();
        $missions = CompanyContent::where('section', 'mission')
            ->orderBy('sort_order')
            ->pluck('title');
        $clients = CompanyContent::where('section', 'client')
            ->orderBy('sort_order')
            ->pluck('title');

        return view('pages.about', [
            'identity' => $identity,
            'missions' => $missions,
            'clients' => $clients,
        ]);
    }
}
