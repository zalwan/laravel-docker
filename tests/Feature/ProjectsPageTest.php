<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_projects_page_loads_and_lists_seeded_projects(): void
    {
        Project::create([
            'title' => 'Sample Project',
            'description' => 'A test project description.',
            'teknologi' => ['PHP', 'Laravel'],
            'image' => 'sample.png',
            'status' => 'selesai',
        ]);

        $response = $this->get('/projects');

        $response->assertOk();
        $response->assertSee('Sample Project');
        $response->assertSee('A test project description.');
        $response->assertSee('PHP');
        $response->assertSee('Laravel');
    }

    public function test_projects_page_shows_empty_state_when_no_projects(): void
    {
        $response = $this->get('/projects');

        $response->assertOk();
        $response->assertSee('No projects to show yet.');
    }

    public function test_teknologi_is_cast_to_array(): void
    {
        $project = Project::create([
            'title' => 'Cast Test',
            'teknologi' => ['Go', 'Rust'],
            'status' => 'planned',
        ]);

        $this->assertIsArray($project->fresh()->teknologi);
        $this->assertSame(['Go', 'Rust'], $project->fresh()->teknologi);
    }
}
