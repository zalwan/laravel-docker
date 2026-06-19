<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Digital Learning Platform Preview',
                'description' => 'Ilustrasi tampilan pembelajaran digital BAWANA.',
                'image_path' => 'images/projects/elearning.png',
                'alt_text' => 'Digital learning platform preview',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'title' => 'Enterprise Learning Dashboard',
                'description' => 'Contoh dashboard operasional untuk pengelolaan pembelajaran perusahaan.',
                'image_path' => 'images/projects/erp.png',
                'alt_text' => 'Enterprise learning dashboard',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'title' => 'Employee Development Workspace',
                'description' => 'Contoh workspace pengembangan karyawan dan HR learning management.',
                'image_path' => 'images/projects/hrms.png',
                'alt_text' => 'Employee development workspace',
                'sort_order' => 3,
                'is_published' => true,
            ],
        ];

        foreach ($items as $item) {
            GalleryItem::updateOrCreate(
                ['image_path' => $item['image_path']],
                [
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'alt_text' => $item['alt_text'],
                    'sort_order' => $item['sort_order'],
                    'is_published' => $item['is_published'],
                ]
            );
        }
    }
}
