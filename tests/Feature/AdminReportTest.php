<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\GalleryItem;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\CompanyContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_export_project_summary_pdf(): void
    {
        $this->seed(CompanyContentSeeder::class);
        $user = User::factory()->create();
        Article::create([
            'title' => 'Report Article',
            'slug' => 'report-article',
            'body' => 'Report body',
            'status' => 'published',
        ]);
        Product::create([
            'name' => 'Report Product',
            'slug' => 'report-product',
            'status' => 'active',
        ]);
        GalleryItem::create([
            'title' => 'Report Gallery',
            'image_path' => 'gallery/report.jpg',
            'is_published' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin/reports/project-summary.pdf');

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
        $this->assertStringStartsWith('%PDF', $response->getContent());
    }
}
