<?php

namespace Tests\Feature;

use App\Models\PromoProduct;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PromoProductCrudTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['email' => 'admin@example.com', 'is_admin' => true]);
    }

    public function test_guest_cannot_create_product(): void
    {
        $this->post('/admin/products', ['name' => 'Test'])
            ->assertRedirect('/admin/login');
    }

    public function test_admin_can_create_product(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())
            ->post('/admin/products', [
                'name' => 'Kampas Rem Belakang',
                'description' => 'Kampas rem berkualitas.',
                'normal_price' => 150000,
                'promo_price' => 120000,
                'whatsapp_number' => '081234567890',
                'image' => UploadedFile::fake()->image('rem.jpg', 400, 300),
                'is_active' => '1',
                'sort_order' => 5,
            ])->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('promo_products', [
            'name' => 'Kampas Rem Belakang',
            'slug' => 'kampas-rem-belakang',
            'promo_price' => 120000,
        ]);

        $product = PromoProduct::where('slug', 'kampas-rem-belakang')->firstOrFail();
        $this->assertNotNull($product->image);
        Storage::disk('public')->assertExists($product->image);
    }

    public function test_admin_can_edit_product(): void
    {
        $product = PromoProduct::create([
            'name' => 'Produk Awal',
            'slug' => 'produk-awal',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $this->actingAs($this->admin())
            ->put("/admin/products/{$product->id}", [
                'name' => 'Produk Diubah',
                'description' => 'Deskripsi baru.',
                'normal_price' => 200000,
                'promo_price' => 170000,
                'is_active' => '1',
            ])->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('promo_products', [
            'id' => $product->id,
            'name' => 'Produk Diubah',
            'slug' => 'produk-diubah',
        ]);
    }

    public function test_admin_can_delete_product(): void
    {
        Storage::fake('public');

        $path = UploadedFile::fake()->image('hapus.jpg')->store('products', 'public');

        $product = PromoProduct::create([
            'name' => 'Produk Dihapus',
            'slug' => 'produk-dihapus',
            'image' => $path,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $this->actingAs($this->admin())
            ->delete("/admin/products/{$product->id}")
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseMissing('promo_products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($path);
    }

    public function test_admin_can_toggle_product_status(): void
    {
        $product = PromoProduct::create([
            'name' => 'Produk Toggle',
            'slug' => 'produk-toggle',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $this->actingAs($this->admin())
            ->patch("/admin/products/{$product->id}/toggle")
            ->assertRedirect();

        $this->assertDatabaseHas('promo_products', ['id' => $product->id, 'is_active' => false]);
    }

    public function test_product_name_is_required(): void
    {
        $this->actingAs($this->admin())
            ->post('/admin/products', [])
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('promo_products', 0);
    }

    public function test_product_slug_is_unique(): void
    {
        PromoProduct::create([
            'name' => 'Produk Satu',
            'slug' => 'produk-satu',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $this->actingAs($this->admin())
            ->post('/admin/products', [
                'name' => 'Produk Satu',
                'slug' => 'produk-satu',
            ])->assertSessionHasErrors('slug');
    }

    public function test_invalid_image_upload_is_rejected(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())
            ->post('/admin/products', [
                'name' => 'Produk Gambar Salah',
                'image' => UploadedFile::fake()->create('hack.txt', 100, 'text/plain'),
            ])->assertSessionHasErrors('image');

        $this->assertDatabaseCount('promo_products', 0);
    }
}