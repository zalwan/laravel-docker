<?php

namespace App\Http\Controllers;

use App\Models\CompanyContent;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function index(): View
    {
        $contents = CompanyContent::orderBy('section')
            ->orderBy('sort_order')
            ->paginate(10);

        return view('pages.contents', compact('contents'));
    }
}
