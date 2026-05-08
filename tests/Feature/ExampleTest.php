<?php

namespace Tests\Feature;

use App\Models\Destination;
use Database\Seeders\DestinationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_returns_uts_theme_content(): void
    {
        $this->seed(DestinationSeeder::class);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Daftar Wisata Alam Indonesia');
        $response->assertSee('NIM 241011750067');
        $response->assertSee('Digit akhir 7');
    }

    public function test_destination_seeder_creates_required_dummy_data(): void
    {
        $this->seed(DestinationSeeder::class);

        $this->assertSame(10, Destination::count());
        $this->assertDatabaseHas('destinations', [
            'name' => 'Raja Ampat',
            'region' => 'Papua Barat Daya',
        ]);
    }

    public function test_destination_images_exist_in_public_assets_images(): void
    {
        $this->seed(DestinationSeeder::class);

        foreach (Destination::all() as $destination) {
            $this->assertFileExists(public_path('assets/images/'.$destination->image));
        }
    }

    public function test_destination_list_page_is_paginated_and_uses_cards(): void
    {
        $this->seed(DestinationSeeder::class);

        $response = $this->get('/destinations');

        $response->assertOk();
        $response->assertSee('Daftar Wisata Alam');
        $response->assertSee('Lihat Detail');
        $response->assertSee('assets/images/', false);
        $response->assertViewHas('destinations', function ($destinations) {
            return $destinations->perPage() === 6
                && $destinations->count() === 6
                && $destinations->total() === 10;
        });

        $this->get('/destinations?page=2')->assertOk();
    }

    public function test_destination_detail_page_is_available(): void
    {
        $this->seed(DestinationSeeder::class);

        $destination = Destination::where('name', 'Kawah Ijen')->firstOrFail();

        $response = $this->get(route('destinations.show', $destination));

        $response->assertOk();
        $response->assertSee($destination->name);
        $response->assertSee($destination->region);
        $response->assertSee($destination->description);
        $response->assertSee($destination->image);
    }
}
