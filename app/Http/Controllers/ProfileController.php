<?php

namespace App\Http\Controllers;

use App\Models\CompanyContent;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $intro = CompanyContent::where('section', 'profile_intro')
            ->orderBy('sort_order')
            ->first();
        $vision = CompanyContent::where('section', 'profile_vision')
            ->orderBy('sort_order')
            ->first();
        $targetMarket = CompanyContent::where('section', 'profile_target_market')
            ->orderBy('sort_order')
            ->first();
        $identity = CompanyContent::where('section', 'identity')
            ->orderBy('sort_order')
            ->get();
        $missions = CompanyContent::where('section', 'mission')
            ->orderBy('sort_order')
            ->pluck('title');
        $clients = CompanyContent::where('section', 'client')
            ->orderBy('sort_order')
            ->pluck('title');

        return view('pages.profile', [
            'intro' => $intro,
            'vision' => $vision,
            'targetMarket' => $targetMarket,
            'identity' => $identity,
            'missions' => $missions,
            'clients' => $clients,
        ]);
    }
}
