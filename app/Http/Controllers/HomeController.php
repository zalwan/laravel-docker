<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredDestinations = Destination::orderBy('ticket_price')
            ->limit(3)
            ->get();

        return view('pages.home', [
            'featuredDestinations' => $featuredDestinations,
            'destinationCount' => Destination::count(),
        ]);
    }
}
