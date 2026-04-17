<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the home page.
     */
    public function index(): View
    {
        return view('home', [
            'title' => 'Welcome to Laravel',
            'message' => 'Your application is running successfully!'
        ]);
    }

    /**
     * Show the about page.
     */
    public function about(): View
    {
        return view('about', [
            'title' => 'About Us'
        ]);
    }

    /**
     * Show the contact page
     */

    public function contact(): View
    {
        return view('contact', [
            'title' => 'Contact Us'
        ]);
        
    }
}
