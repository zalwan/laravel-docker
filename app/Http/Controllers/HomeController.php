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
        $regionCount = Destination::distinct('region')->count('region');
        $lowestTicketPrice = Destination::min('ticket_price') ?? 0;

        return view('pages.home', [
            'featuredDestinations' => $featuredDestinations,
            'destinationCount' => Destination::count(),
            'regionCount' => $regionCount,
            'lowestTicketPrice' => $lowestTicketPrice,
        ]);
    }
}
