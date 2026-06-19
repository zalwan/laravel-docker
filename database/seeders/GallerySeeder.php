<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Digital Learning Platform Preview',
                'description' => 'Ilustrasi tampilan pembelajaran digital BAWANA.',
                'source' => public_path('images/projects/elearning.png'),
                'image_path' => 'gallery/elearning.png',
                'alt_text' => 'Digital learning platform preview',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'title' => 'Enterprise Learning Dashboard',
                'description' => 'Contoh dashboard operasional untuk pengelolaan pembelajaran perusahaan.',
                'source' => public_path('images/projects/erp.png'),
                'image_path' => 'gallery/erp.png',
                'alt_text' => 'Enterprise learning dashboard',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'title' => 'Employee Development Workspace',
                'description' => 'Contoh workspace pengembangan karyawan dan HR learning management.',
                'source' => public_path('images/projects/hrms.png'),
                'image_path' => 'gallery/hrms.png',
                'alt_text' => 'Employee development workspace',
                'sort_order' => 3,
                'is_published' => true,
            ],
        ];

        foreach ($items as $item) {
            if (File::exists($item['source']) && ! Storage::disk('public')->exists($item['image_path'])) {
                Storage::disk('public')->put($item['image_path'], File::get($item['source']));
            }

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
