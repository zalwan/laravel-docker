<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_product(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/products', [
            'name' => 'Learning Platform',
            'slug' => '',
            'description' => 'Platform description',
            'price' => '1500000',
            'image' => 'platform.png',
            'status' => 'active',
            'is_featured' => '1',
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Learning Platform',
            'slug' => 'learning-platform',
            'status' => 'active',
            'is_featured' => true,
        ]);
    }

    public function test_admin_can_update_product(): void
    {
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Old Product',
            'slug' => 'old-product',
            'description' => 'Old description',
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)->put("/admin/products/{$product->id}", [
            'name' => 'Updated Product',
            'slug' => 'updated-product',
            'description' => 'Updated description',
            'price' => '2000000',
            'image' => '',
            'status' => 'inactive',
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product',
            'slug' => 'updated-product',
            'status' => 'inactive',
            'is_featured' => false,
        ]);
    }

    public function test_admin_can_delete_product(): void
    {
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Deleted Product',
            'slug' => 'deleted-product',
        ]);

        $response = $this->actingAs($user)->delete("/admin/products/{$product->id}");

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_admin_can_view_product_index(): void
    {
        $user = User::factory()->create();
        Product::create([
            'name' => 'Visible Product',
            'slug' => 'visible-product',
        ]);

        $response = $this->actingAs($user)->get('/admin/products');

        $response->assertStatus(200);
        $response->assertSee('Visible Product');
    }
}
