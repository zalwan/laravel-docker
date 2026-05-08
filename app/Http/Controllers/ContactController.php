<?php

namespace App\Http\Controllers;

use App\Models\CompanyContent;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = CompanyContent::where('section', 'contact')
            ->orderBy('sort_order')
            ->get();

        return view('pages.contact', compact('contacts'));
    }
}
