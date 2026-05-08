<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'stats' => [
                ['value' => '650+', 'label' => 'Kursus digital'],
                ['value' => '5000+', 'label' => 'Konten pembelajaran'],
                ['value' => '2500+', 'label' => 'Video learning'],
                ['value' => '100+', 'label' => 'Perusahaan terbantu'],
            ],
            'highlights' => [
                'Learning Experience Platform berbasis AI',
                'Ribuan konten digital untuk employee development',
                'Customer success support untuk adopsi pembelajaran',
            ],
        ]);
    }
}
