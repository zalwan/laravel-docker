<?php

namespace Tests\Feature;

use App\Models\CompanyContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCompanyProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_company_profile_index(): void
    {
        $user = User::factory()->create();
        CompanyContent::create([
            'section' => 'identity',
            'label' => 'Brand',
            'value' => 'BAWANA',
        ]);

        $response = $this->actingAs($user)->get('/admin/profile');

        $response->assertStatus(200);
        $response->assertSee('Company Profile Content');
        $response->assertSee('BAWANA');
    }

    public function test_admin_can_create_company_profile_content(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/profile', [
            'section' => 'service',
            'title' => 'New Service',
            'description' => 'New service description',
            'value' => '',
            'label' => '',
            'items' => "Feature A\nFeature B",
            'image' => 'service.png',
            'sort_order' => 9,
        ]);

        $response->assertRedirect('/admin/profile');
        $this->assertDatabaseHas('company_contents', [
            'section' => 'service',
            'title' => 'New Service',
            'image' => 'service.png',
            'sort_order' => 9,
        ]);
        $this->assertSame(['Feature A', 'Feature B'], CompanyContent::firstWhere('title', 'New Service')->items);
    }

    public function test_admin_can_update_company_profile_content(): void
    {
        $user = User::factory()->create();
        $content = CompanyContent::create([
            'section' => 'client',
            'title' => 'Old Client',
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($user)->put("/admin/profile/{$content->id}", [
            'section' => 'client',
            'title' => 'Updated Client',
            'description' => '',
            'value' => '',
            'label' => '',
            'items' => '',
            'image' => '',
            'sort_order' => 2,
        ]);

        $response->assertRedirect('/admin/profile');
        $this->assertDatabaseHas('company_contents', [
            'id' => $content->id,
            'title' => 'Updated Client',
            'sort_order' => 2,
        ]);
    }

    public function test_admin_can_delete_company_profile_content(): void
    {
        $user = User::factory()->create();
        $content = CompanyContent::create([
            'section' => 'client',
            'title' => 'Deleted Client',
        ]);

        $response = $this->actingAs($user)->delete("/admin/profile/{$content->id}");

        $response->assertRedirect('/admin/profile');
        $this->assertDatabaseMissing('company_contents', [
            'id' => $content->id,
        ]);
    }
}
