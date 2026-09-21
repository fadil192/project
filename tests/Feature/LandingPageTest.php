<?php

namespace Tests\Feature;

use App\Models\ContactSetting;
use App\Models\Hero;
use App\Models\PromoProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');

        // Data default agar landing page punya konten
        $this->seed();
    }

    public function test_landing_page_can_be_opened_without_login(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('AutoPart Jaya');
        $response->assertSee('Produk Promo');
        $response->assertDontSee('Layanan Kami');
    }

    public function test_landing_page_takes_data_from_database(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Kampas Rem Depan');
        $response->assertSee('Filter Oli Universal');
    }

    public function test_landing_page_shows_newly_created_active_product(): void
    {
        $response = $this->get('/');

        $product = PromoProduct::create([
            'name' => 'Lampu LED Mobil',
            'slug' => 'lampu-led-mobil-test-'.uniqid(),
            'description' => 'Produk baru untuk pengujian.',
            'normal_price' => 150000,
            'promo_price' => 120000,
            'is_active' => true,
            'sort_order' => 99,
        ]);

        $response = $this->get('/');
        $response->assertSee('Lampu LED Mobil');
    }

    public function test_hero_is_fetched_from_database(): void
    {
        Hero::query()->delete();

        $response = $this->get('/');
        $response->assertDontSee('Spare Part Asli, Harga Bersahabat');

        Hero::create([
            'title' => 'Kualitas Terbaik Untuk Kendaraan Anda',
            'subtitle' => 'Subtitle test hero',
            'is_active' => true,
        ]);

        $response = $this->get('/');
        $response->assertSee('Kualitas Terbaik Untuk Kendaraan Anda');
    }

    public function test_contact_setting_is_fetched_from_database(): void
    {
        $setting = ContactSetting::query()->firstOrFail();
        $setting->update(['store_name' => 'Bengkel Test Jaya']);

        $response = $this->get('/');
        $response->assertSee('Bengkel Test Jaya');
    }
}