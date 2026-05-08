<?php

namespace Tests\Feature;

use App\Models\CompanyContent;
use Database\Seeders\CompanyContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_returns_company_profile_content(): void
    {
        $this->seed(CompanyContentSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('BAWANA');
        $response->assertSee('Digital learning untuk pengembangan talenta perusahaan.');
    }

    public function test_company_profile_pages_are_available(): void
    {
        $this->seed(CompanyContentSeeder::class);

        $pages = [
            '/about' => 'Tentang BAWANA',
            '/services' => 'Produk',
            '/contents' => 'Dynamic Contents',
            '/contact' => 'PT Meta BAWANA Indonesia',
        ];

        foreach ($pages as $uri => $content) {
            $response = $this->get($uri);

            $response->assertStatus(200);
            $response->assertSee($content);
        }
    }

    public function test_company_content_seeder_creates_dynamic_content(): void
    {
        $this->seed(CompanyContentSeeder::class);

        $this->assertGreaterThanOrEqual(10, CompanyContent::count());
        $this->assertSame(4, CompanyContent::where('section', 'service')->count());
        $this->assertSame(10, CompanyContent::where('section', 'client')->count());
        $this->assertSame(0, CompanyContent::whereNull('image')->count());
    }

    public function test_company_content_items_are_cast_to_array(): void
    {
        $content = CompanyContent::create([
            'section' => 'service',
            'title' => 'Cast Test',
            'items' => ['AI Learning', 'Analytics'],
        ]);

        $this->assertIsArray($content->fresh()->items);
        $this->assertSame(['AI Learning', 'Analytics'], $content->fresh()->items);
    }

    public function test_dynamic_contents_page_is_paginated(): void
    {
        $this->seed(CompanyContentSeeder::class);

        $response = $this->get('/contents');

        $response->assertStatus(200);
        $response->assertSee('Lihat Detail');
        $response->assertSee('images/projects/', false);
        $response->assertViewHas('contents', function ($contents) {
            return $contents->perPage() === 10
                && $contents->count() === 10
                && $contents->total() >= 10;
        });

        $this->get('/contents?page=2')->assertStatus(200);
    }

    public function test_dynamic_content_detail_page_is_available(): void
    {
        $this->seed(CompanyContentSeeder::class);

        $content = CompanyContent::where('section', 'service')->firstOrFail();

        $response = $this->get(route('contents.show', $content));

        $response->assertStatus(200);
        $response->assertSee($content->title);
        $response->assertSee($content->description);
        $response->assertSee($content->image);
    }
}
