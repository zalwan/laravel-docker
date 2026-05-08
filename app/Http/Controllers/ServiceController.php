<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('pages.services', [
            'services' => [
                [
                    'title' => 'PUSTAKA BAWANA',
                    'description' => 'Perpustakaan digital pembelajaran dengan video learning, interactive learning, audio learning, quiz, podcast, reading materials, dan gamification.',
                    'features' => ['Leadership', 'Business Skill', 'Financial', 'Sales & Marketing', 'Technology', 'Service Quality'],
                ],
                [
                    'title' => 'Learning Experience Platform',
                    'description' => 'Platform pembelajaran digital berbasis AI untuk mengelola journey, rekomendasi belajar, IDP, analytics, webinar, dan white label learning platform.',
                    'features' => ['AI Recommendation', 'Learning Journey', 'Gamification', 'Learning Analytics', 'AI Learning Assistant', 'White Label Platform'],
                ],
                [
                    'title' => 'Customer Success Team',
                    'description' => 'Pendampingan implementasi untuk onboarding, monitoring, engagement, learning adoption, dan konsultasi budaya belajar.',
                    'features' => ['Onboarding', 'Monitoring', 'Employee Engagement', 'Learning Adoption', 'Consulting'],
                ],
                [
                    'title' => 'AI Learning & Roleplay Simulation',
                    'description' => 'Simulasi percakapan dan roleplay berbasis avatar AI dalam Bahasa Indonesia untuk latihan kondisi kerja nyata dan feedback otomatis.',
                    'features' => ['Roleplay Simulation', 'Avatar AI', 'Feedback Otomatis', 'Personalized Learning'],
                ],
            ],
            'advantages' => [
                '3-in-1 digital learning solution: platform, content, dan customer success.',
                'AI-driven learning untuk rekomendasi dan pengalaman belajar personal.',
                'Integrasi global learning content seperti LinkedIn Learning dan Percipio Skillsoft.',
                'Mobile learning untuk akses pembelajaran fleksibel kapan saja.',
            ],
        ]);
    }
}
