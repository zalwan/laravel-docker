<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_projects_page_loads(): void
    {
        Project::create([
            'title' => 'Admin Visible Project',
            'status' => 'planned',
        ]);

        $response = $this->get('/admin/projects');

        $response->assertOk();
        $response->assertSee('Kelola Projects');
        $response->assertSee('Admin Visible Project');
    }

    public function test_admin_can_create_project(): void
    {
        $response = $this->post('/admin/projects', [
            'title' => 'New Admin Project',
            'description' => 'Created from admin route.',
            'teknologi' => 'PHP, Laravel, MySQL',
            'image' => 'admin.png',
            'status' => 'on progress',
        ]);

        $response->assertRedirect('/admin/projects');

        $this->assertDatabaseHas('projects', [
            'title' => 'New Admin Project',
            'description' => 'Created from admin route.',
            'image' => 'admin.png',
            'status' => 'on progress',
        ]);

        $this->assertSame(['PHP', 'Laravel', 'MySQL'], Project::firstWhere('title', 'New Admin Project')->teknologi);
    }

    public function test_admin_can_update_project(): void
    {
        $project = Project::create([
            'title' => 'Old Project',
            'status' => 'planned',
        ]);

        $response = $this->put("/admin/projects/{$project->id}", [
            'title' => 'Updated Project',
            'description' => 'Updated description.',
            'teknologi' => 'Docker, Redis',
            'image' => 'updated.png',
            'status' => 'selesai',
        ]);

        $response->assertRedirect('/admin/projects');

        $project->refresh();

        $this->assertSame('Updated Project', $project->title);
        $this->assertSame(['Docker', 'Redis'], $project->teknologi);
        $this->assertSame('selesai', $project->status);
    }

    public function test_admin_can_delete_project(): void
    {
        $project = Project::create([
            'title' => 'Project to Delete',
            'status' => 'planned',
        ]);

        $response = $this->delete("/admin/projects/{$project->id}");

        $response->assertRedirect('/admin/projects');
        $this->assertDatabaseMissing('projects', ['title' => 'Project to Delete']);
    }
}
