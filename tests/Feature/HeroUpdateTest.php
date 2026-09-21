<?php

namespace Tests\Feature;

use App\Models\Hero;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HeroUpdateTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['email' => 'admin@example.com', 'is_admin' => true]);
    }

    public function test_admin_can_update_hero(): void
    {
        $hero = Hero::create([
            'title' => 'Judul Lama',
            'subtitle' => 'Subtitle lama',
            'is_active' => true,
        ]);

        $this->actingAs($this->admin())
            ->put('/admin/hero', [
                'title' => 'Judul Baru Hero',
                'subtitle' => 'Subtitle baru',
                'button_text' => 'Lihat Produk',
                'button_url' => '#produk-promo',
                'whatsapp_number' => '081234567890',
                'whatsapp_message' => 'Halo, saya butuh bantuan.',
                'is_active' => '1',
            ])->assertRedirect(route('admin.hero.edit'));

        $this->assertDatabaseHas('hero_banners', [
            'id' => $hero->id,
            'title' => 'Judul Baru Hero',
            'subtitle' => 'Subtitle baru',
        ]);
    }

    public function test_admin_can_upload_and_replace_hero_image(): void
    {
        Storage::fake('public');

        $oldPath = UploadedFile::fake()->image('old.jpg')->store('hero', 'public');

        $hero = Hero::create([
            'title' => 'Hero',
            'image' => $oldPath,
            'is_active' => true,
        ]);

        $this->actingAs($this->admin())
            ->put('/admin/hero', [
                'title' => 'Hero',
                'image' => UploadedFile::fake()->image('new.jpg', 1200, 600),
                'is_active' => '1',
            ])->assertRedirect(route('admin.hero.edit'));

        $hero->refresh();
        $this->assertNotEquals($oldPath, $hero->image);
        Storage::disk('public')->assertExists($hero->image);
        Storage::disk('public')->assertMissing($oldPath);
    }

    public function test_hero_title_is_required(): void
    {
        $this->actingAs($this->admin())
            ->put('/admin/hero', ['subtitle' => 'Tanpa judul'])
            ->assertSessionHasErrors('title');
    }

    public function test_guest_cannot_update_hero(): void
    {
        $this->put('/admin/hero', ['title' => 'Hack'])
            ->assertRedirect('/admin/login');
    }
}