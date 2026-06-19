<?php

namespace Tests\Feature;

use App\Models\GalleryItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AdminGalleryTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_gallery_item_with_upload(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/gallery', [
            'title' => 'Office Event',
            'description' => 'Event documentation',
            'alt_text' => 'Office event photo',
            'sort_order' => 3,
            'is_published' => '1',
            'image' => $this->fakePng('event.png'),
        ]);

        $response->assertRedirect('/admin/gallery');

        $galleryItem = GalleryItem::firstOrFail();
        $this->assertSame('Office Event', $galleryItem->title);
        $this->assertTrue($galleryItem->is_published);
        $this->assertStringStartsWith('database/gallery/', $galleryItem->image_path);
        $this->assertNotEmpty($galleryItem->image_data);
        $this->assertSame('image/png', $galleryItem->image_mime);

        $this->get($galleryItem->imageUrl())
            ->assertStatus(200)
            ->assertHeader('content-type', 'image/png');
    }

    public function test_admin_can_update_gallery_item_and_replace_upload(): void
    {
        $user = User::factory()->create();
        $galleryItem = GalleryItem::create([
            'title' => 'Old Gallery',
            'image_path' => 'database/gallery/old.jpg',
            'image_data' => base64_encode('old'),
            'image_mime' => 'image/jpeg',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        $response = $this->actingAs($user)->put("/admin/gallery/{$galleryItem->id}", [
            'title' => 'Updated Gallery',
            'description' => 'Updated description',
            'alt_text' => 'Updated alt',
            'sort_order' => 2,
            'image' => $this->fakePng('new.png'),
        ]);

        $response->assertRedirect('/admin/gallery');

        $galleryItem->refresh();
        $this->assertSame('Updated Gallery', $galleryItem->title);
        $this->assertFalse($galleryItem->is_published);
        $this->assertStringStartsWith('database/gallery/', $galleryItem->image_path);
        $this->assertNotSame(base64_encode('old'), $galleryItem->image_data);
        $this->assertSame('image/png', $galleryItem->image_mime);
    }

    public function test_admin_can_delete_gallery_item(): void
    {
        $user = User::factory()->create();
        $galleryItem = GalleryItem::create([
            'title' => 'Deleted Gallery',
            'image_path' => 'database/gallery/delete.jpg',
            'image_data' => base64_encode('delete'),
            'image_mime' => 'image/jpeg',
        ]);

        $response = $this->actingAs($user)->delete("/admin/gallery/{$galleryItem->id}");

        $response->assertRedirect('/admin/gallery');
        $this->assertDatabaseMissing('gallery_items', [
            'id' => $galleryItem->id,
        ]);
    }

    public function test_admin_can_view_gallery_index(): void
    {
        $user = User::factory()->create();
        GalleryItem::create([
            'title' => 'Visible Gallery',
            'image_path' => 'gallery/visible.jpg',
        ]);

        $response = $this->actingAs($user)->get('/admin/gallery');

        $response->assertStatus(200);
        $response->assertSee('Visible Gallery');
        $response->assertSee('storage/gallery/visible.jpg');
    }

    public function test_admin_gallery_index_supports_seeded_public_assets(): void
    {
        $user = User::factory()->create();
        GalleryItem::create([
            'title' => 'Seeded Gallery',
            'image_path' => 'images/projects/elearning.png',
        ]);

        $response = $this->actingAs($user)->get('/admin/gallery');

        $response->assertStatus(200);
        $response->assertSee('Seeded Gallery');
        $response->assertSee('images/projects/elearning.png');
    }

    public function test_admin_gallery_index_uses_database_image_route_for_uploads(): void
    {
        $user = User::factory()->create();
        $galleryItem = GalleryItem::create([
            'title' => 'Database Gallery',
            'image_path' => 'database/gallery/visible.jpg',
            'image_data' => base64_encode('image-bytes'),
            'image_mime' => 'image/jpeg',
        ]);

        $response = $this->actingAs($user)->get('/admin/gallery');

        $response->assertStatus(200);
        $response->assertSee('Database Gallery');
        $response->assertSee(route('gallery.image', $galleryItem));
    }

    private function fakePng(string $name): UploadedFile
    {
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII=');

        return UploadedFile::fake()->createWithContent($name, $png);
    }
}
