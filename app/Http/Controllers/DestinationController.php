<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function index(): View
    {
        $destinations = Destination::orderBy('name')->paginate(6);

        return view('pages.destinations', compact('destinations'));
    }

    public function show(Destination $destination): View
    {
        return view('pages.destination-detail', compact('destination'));
    }
}
