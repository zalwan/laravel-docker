<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Learning Experience Platform',
                'slug' => 'learning-experience-platform',
                'description' => 'Platform pembelajaran digital untuk journey, rekomendasi belajar, analytics, webinar, dan white label learning portal.',
                'price' => 15000000,
                'image' => 'elearning.png',
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'name' => 'Pustaka BAWANA',
                'slug' => 'pustaka-bawana',
                'description' => 'Perpustakaan konten digital berisi video learning, reading material, quiz, podcast, dan interactive learning.',
                'price' => 7500000,
                'image' => 'erp.png',
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'name' => 'AI Roleplay Simulation',
                'slug' => 'ai-roleplay-simulation',
                'description' => 'Simulasi percakapan berbasis avatar AI untuk latihan sales, service, leadership, dan feedback otomatis.',
                'price' => 12000000,
                'image' => 'hrms.png',
                'status' => 'active',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
