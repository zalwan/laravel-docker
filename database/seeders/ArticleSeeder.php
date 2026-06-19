<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Membangun Budaya Belajar Berkelanjutan di Perusahaan',
                'slug' => 'membangun-budaya-belajar-berkelanjutan-di-perusahaan',
                'excerpt' => 'Cara membangun learning culture yang konsisten melalui platform digital dan dukungan HR.',
                'body' => 'Budaya belajar berkelanjutan membutuhkan kombinasi strategi, konten yang relevan, pengukuran yang jelas, dan kemudahan akses. Dengan platform digital learning, perusahaan dapat menghubungkan kebutuhan kompetensi dengan journey belajar yang terstruktur.',
                'status' => 'published',
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Peran AI dalam Employee Development',
                'slug' => 'peran-ai-dalam-employee-development',
                'excerpt' => 'AI membantu personalisasi rekomendasi belajar, roleplay, dan feedback untuk karyawan.',
                'body' => 'AI dapat mempercepat proses employee development dengan memberi rekomendasi konten, simulasi percakapan, dan umpan balik yang lebih cepat. Pendekatan ini membantu karyawan belajar berdasarkan kebutuhan peran masing-masing.',
                'status' => 'published',
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Checklist Implementasi Learning Platform',
                'slug' => 'checklist-implementasi-learning-platform',
                'excerpt' => 'Hal-hal yang perlu disiapkan sebelum menjalankan platform pembelajaran digital.',
                'body' => 'Implementasi learning platform sebaiknya dimulai dari pemetaan stakeholder, data pengguna, struktur konten, target adoption, dan rencana komunikasi internal. Checklist yang jelas membantu tim HR dan L&D menjalankan rollout lebih terukur.',
                'status' => 'draft',
                'published_at' => null,
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['slug' => $article['slug']],
                $article
            );
        }
    }
}
