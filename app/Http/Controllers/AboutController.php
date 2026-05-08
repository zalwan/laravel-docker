<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        return view('pages.about', [
            'identity' => [
                'Nama Perusahaan' => 'PT Meta BAWANA Indonesia',
                'Brand' => 'BAWANA',
                'Industri' => 'Digital Learning / Corporate Learning',
                'Fokus Bisnis' => 'Learning Experience Platform & Employee Development',
                'Tahun Berdiri Grup' => '2003 (Netpolitan Group)',
                'Kantor Pusat' => 'BSD, Tangerang, Indonesia',
            ],
            'missions' => [
                'Membantu perusahaan meningkatkan kompetensi karyawan.',
                'Menyediakan platform pembelajaran digital yang modern dan mudah diakses.',
                'Mengintegrasikan pembelajaran ke aktivitas kerja sehari-hari.',
                'Mendukung budaya continuous learning di organisasi.',
                'Menghadirkan teknologi AI untuk pengalaman belajar yang lebih efektif.',
            ],
            'clients' => [
                'Astra',
                'BRI',
                'PLN',
                'Telkomsel',
                'Allianz',
                'OJK',
                'UNICEF',
                'Smartfren',
                'Siloam',
                'BI',
            ],
        ]);
    }
}
