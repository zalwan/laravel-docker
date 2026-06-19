<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_article(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/articles', [
            'title' => 'Learning Culture',
            'slug' => '',
            'excerpt' => 'Short article summary',
            'body' => 'Long article body',
            'status' => 'published',
            'published_at' => '2026-06-19 10:00:00',
        ]);

        $response->assertRedirect('/admin/articles');
        $this->assertDatabaseHas('articles', [
            'title' => 'Learning Culture',
            'slug' => 'learning-culture',
            'status' => 'published',
        ]);
    }

    public function test_admin_can_update_article(): void
    {
        $user = User::factory()->create();
        $article = Article::create([
            'title' => 'Old Article',
            'slug' => 'old-article',
            'body' => 'Old body',
        ]);

        $response = $this->actingAs($user)->put("/admin/articles/{$article->id}", [
            'title' => 'Updated Article',
            'slug' => 'updated-article',
            'excerpt' => '',
            'body' => 'Updated body',
            'status' => 'draft',
            'published_at' => '',
        ]);

        $response->assertRedirect('/admin/articles');
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'Updated Article',
            'slug' => 'updated-article',
        ]);
    }

    public function test_admin_can_delete_article(): void
    {
        $user = User::factory()->create();
        $article = Article::create([
            'title' => 'Deleted Article',
            'slug' => 'deleted-article',
            'body' => 'Body',
        ]);

        $response = $this->actingAs($user)->delete("/admin/articles/{$article->id}");

        $response->assertRedirect('/admin/articles');
        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
        ]);
    }

    public function test_admin_can_view_article_index(): void
    {
        $user = User::factory()->create();
        Article::create([
            'title' => 'Visible Article',
            'slug' => 'visible-article',
            'body' => 'Body',
        ]);

        $response = $this->actingAs($user)->get('/admin/articles');

        $response->assertStatus(200);
        $response->assertSee('Visible Article');
    }
}
