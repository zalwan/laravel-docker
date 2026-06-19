<?php

namespace Tests\Feature;

use App\Models\GalleryItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminGalleryTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_gallery_item_with_upload(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/gallery', [
            'title' => 'Office Event',
            'description' => 'Event documentation',
            'alt_text' => 'Office event photo',
            'sort_order' => 3,
            'is_published' => '1',
            'image' => UploadedFile::fake()->create('event.jpg', 120, 'image/jpeg'),
        ]);

        $response->assertRedirect('/admin/gallery');

        $galleryItem = GalleryItem::firstOrFail();
        $this->assertSame('Office Event', $galleryItem->title);
        $this->assertTrue($galleryItem->is_published);
        Storage::disk('public')->assertExists($galleryItem->image_path);
    }

    public function test_admin_can_update_gallery_item_and_replace_upload(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        Storage::disk('public')->put('gallery/old.jpg', 'old');
        $galleryItem = GalleryItem::create([
            'title' => 'Old Gallery',
            'image_path' => 'gallery/old.jpg',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        $response = $this->actingAs($user)->put("/admin/gallery/{$galleryItem->id}", [
            'title' => 'Updated Gallery',
            'description' => 'Updated description',
            'alt_text' => 'Updated alt',
            'sort_order' => 2,
            'image' => UploadedFile::fake()->create('new.jpg', 120, 'image/jpeg'),
        ]);

        $response->assertRedirect('/admin/gallery');

        $galleryItem->refresh();
        $this->assertSame('Updated Gallery', $galleryItem->title);
        $this->assertFalse($galleryItem->is_published);
        Storage::disk('public')->assertMissing('gallery/old.jpg');
        Storage::disk('public')->assertExists($galleryItem->image_path);
    }

    public function test_admin_can_delete_gallery_item_and_file(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        Storage::disk('public')->put('gallery/delete.jpg', 'delete');
        $galleryItem = GalleryItem::create([
            'title' => 'Deleted Gallery',
            'image_path' => 'gallery/delete.jpg',
        ]);

        $response = $this->actingAs($user)->delete("/admin/gallery/{$galleryItem->id}");

        $response->assertRedirect('/admin/gallery');
        $this->assertDatabaseMissing('gallery_items', [
            'id' => $galleryItem->id,
        ]);
        Storage::disk('public')->assertMissing('gallery/delete.jpg');
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
    }
}
