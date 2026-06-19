<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\CompanyContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_view_dashboard_summary(): void
    {
        $this->seed(CompanyContentSeeder::class);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Profile Data');
        $response->assertSee('Articles');
        $response->assertSee('Products');
        $response->assertSee('Gallery');
        $response->assertSee('Data by Section');
        $response->assertSee('Latest Data');
    }
}
