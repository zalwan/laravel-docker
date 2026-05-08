<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_homepage_returns_company_profile_content(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('BAWANA');
        $response->assertSee('Digital learning untuk pengembangan talenta perusahaan.');
    }

    public function test_company_profile_pages_are_available(): void
    {
        $pages = [
            '/about' => 'Tentang BAWANA',
            '/services' => 'Produk',
            '/contact' => 'PT Meta BAWANA Indonesia',
        ];

        foreach ($pages as $uri => $content) {
            $response = $this->get($uri);

            $response->assertStatus(200);
            $response->assertSee($content);
        }
    }
}
