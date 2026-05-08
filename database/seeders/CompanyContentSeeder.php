<?php

namespace Database\Seeders;

use App\Models\CompanyContent;
use Illuminate\Database\Seeder;

class CompanyContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            [
                'section' => 'stat',
                'value' => '650+',
                'label' => 'Kursus digital',
                'sort_order' => 1,
            ],
            [
                'section' => 'stat',
                'value' => '5000+',
                'label' => 'Konten pembelajaran',
                'sort_order' => 2,
            ],
            [
                'section' => 'stat',
                'value' => '2500+',
                'label' => 'Video learning',
                'sort_order' => 3,
            ],
            [
                'section' => 'stat',
                'value' => '100+',
                'label' => 'Perusahaan terbantu',
                'sort_order' => 4,
            ],
            [
                'section' => 'highlight',
                'title' => 'Learning Experience Platform berbasis AI',
                'sort_order' => 1,
            ],
            [
                'section' => 'highlight',
                'title' => 'Ribuan konten digital untuk employee development',
                'sort_order' => 2,
            ],
            [
                'section' => 'highlight',
                'title' => 'Customer success support untuk adopsi pembelajaran',
                'sort_order' => 3,
            ],
            [
                'section' => 'identity',
                'label' => 'Nama Perusahaan',
                'value' => 'PT Meta BAWANA Indonesia',
                'sort_order' => 1,
            ],
            [
                'section' => 'identity',
                'label' => 'Brand',
                'value' => 'BAWANA',
                'sort_order' => 2,
            ],
            [
                'section' => 'identity',
                'label' => 'Industri',
                'value' => 'Digital Learning / Corporate Learning',
                'sort_order' => 3,
            ],
            [
                'section' => 'identity',
                'label' => 'Fokus Bisnis',
                'value' => 'Learning Experience Platform & Employee Development',
                'sort_order' => 4,
            ],
            [
                'section' => 'identity',
                'label' => 'Tahun Berdiri Grup',
                'value' => '2003 (Netpolitan Group)',
                'sort_order' => 5,
            ],
            [
                'section' => 'identity',
                'label' => 'Kantor Pusat',
                'value' => 'BSD, Tangerang, Indonesia',
                'sort_order' => 6,
            ],
            [
                'section' => 'mission',
                'title' => 'Membantu perusahaan meningkatkan kompetensi karyawan.',
                'sort_order' => 1,
            ],
            [
                'section' => 'mission',
                'title' => 'Menyediakan platform pembelajaran digital yang modern dan mudah diakses.',
                'sort_order' => 2,
            ],
            [
                'section' => 'mission',
                'title' => 'Mengintegrasikan pembelajaran ke aktivitas kerja sehari-hari.',
                'sort_order' => 3,
            ],
            [
                'section' => 'mission',
                'title' => 'Mendukung budaya continuous learning di organisasi.',
                'sort_order' => 4,
            ],
            [
                'section' => 'mission',
                'title' => 'Menghadirkan teknologi AI untuk pengalaman belajar yang lebih efektif.',
                'sort_order' => 5,
            ],
            [
                'section' => 'client',
                'title' => 'Astra',
                'sort_order' => 1,
            ],
            [
                'section' => 'client',
                'title' => 'BRI',
                'sort_order' => 2,
            ],
            [
                'section' => 'client',
                'title' => 'PLN',
                'sort_order' => 3,
            ],
            [
                'section' => 'client',
                'title' => 'Telkomsel',
                'sort_order' => 4,
            ],
            [
                'section' => 'client',
                'title' => 'Allianz',
                'sort_order' => 5,
            ],
            [
                'section' => 'client',
                'title' => 'OJK',
                'sort_order' => 6,
            ],
            [
                'section' => 'client',
                'title' => 'UNICEF',
                'sort_order' => 7,
            ],
            [
                'section' => 'client',
                'title' => 'Smartfren',
                'sort_order' => 8,
            ],
            [
                'section' => 'client',
                'title' => 'Siloam',
                'sort_order' => 9,
            ],
            [
                'section' => 'client',
                'title' => 'BI',
                'sort_order' => 10,
            ],
            [
                'section' => 'service',
                'title' => 'PUSTAKA BAWANA',
                'description' => 'Perpustakaan digital pembelajaran dengan video learning, interactive learning, audio learning, quiz, podcast, reading materials, dan gamification.',
                'items' => ['Leadership', 'Business Skill', 'Financial', 'Sales & Marketing', 'Technology', 'Service Quality'],
                'sort_order' => 1,
            ],
            [
                'section' => 'service',
                'title' => 'Learning Experience Platform',
                'description' => 'Platform pembelajaran digital berbasis AI untuk mengelola journey, rekomendasi belajar, IDP, analytics, webinar, dan white label learning platform.',
                'items' => ['AI Recommendation', 'Learning Journey', 'Gamification', 'Learning Analytics', 'AI Learning Assistant', 'White Label Platform'],
                'sort_order' => 2,
            ],
            [
                'section' => 'service',
                'title' => 'Customer Success Team',
                'description' => 'Pendampingan implementasi untuk onboarding, monitoring, engagement, learning adoption, dan konsultasi budaya belajar.',
                'items' => ['Onboarding', 'Monitoring', 'Employee Engagement', 'Learning Adoption', 'Consulting'],
                'sort_order' => 3,
            ],
            [
                'section' => 'service',
                'title' => 'AI Learning & Roleplay Simulation',
                'description' => 'Simulasi percakapan dan roleplay berbasis avatar AI dalam Bahasa Indonesia untuk latihan kondisi kerja nyata dan feedback otomatis.',
                'items' => ['Roleplay Simulation', 'Avatar AI', 'Feedback Otomatis', 'Personalized Learning'],
                'sort_order' => 4,
            ],
            [
                'section' => 'advantage',
                'title' => '3-in-1 digital learning solution: platform, content, dan customer success.',
                'sort_order' => 1,
            ],
            [
                'section' => 'advantage',
                'title' => 'AI-driven learning untuk rekomendasi dan pengalaman belajar personal.',
                'sort_order' => 2,
            ],
            [
                'section' => 'advantage',
                'title' => 'Integrasi global learning content seperti LinkedIn Learning dan Percipio Skillsoft.',
                'sort_order' => 3,
            ],
            [
                'section' => 'advantage',
                'title' => 'Mobile learning untuk akses pembelajaran fleksibel kapan saja.',
                'sort_order' => 4,
            ],
            [
                'section' => 'contact',
                'label' => 'Perusahaan',
                'value' => 'PT Meta BAWANA Indonesia',
                'sort_order' => 1,
            ],
            [
                'section' => 'contact',
                'label' => 'Alamat',
                'value' => 'Ruko Golden Boulevard C30-31, Bumi Serpong Damai, Tangerang 15320, Indonesia',
                'sort_order' => 2,
            ],
            [
                'section' => 'contact',
                'label' => 'Website',
                'value' => 'bawana.com',
                'description' => 'https://bawana.com',
                'sort_order' => 3,
            ],
            [
                'section' => 'contact',
                'label' => 'LinkedIn',
                'value' => 'PT Meta Bawana Indonesia',
                'description' => 'https://id.linkedin.com/company/meta-bawana-indonesia',
                'sort_order' => 4,
            ],
        ];

        foreach ($contents as $content) {
            CompanyContent::updateOrCreate(
                [
                    'section' => $content['section'],
                    'title' => $content['title'] ?? null,
                    'label' => $content['label'] ?? null,
                ],
                $content
            );
        }
    }
}
