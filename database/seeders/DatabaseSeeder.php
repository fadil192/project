<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use App\Models\ContactSetting;
use App\Models\CtaSection;
use App\Models\Hero;
use App\Models\PageSection;
use App\Models\PromoProduct;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('seed');
        $assets = $this->makePlaceholderImages();

        $this->call(AdminUserSeeder::class);

        Hero::query()->delete();
        Hero::create([
            'title' => 'Spare Part Asli, Harga Bersahabat',
            'subtitle' => 'Pusat spare part dan aksesoris otomotif mobil & motor dengan kualitas terjamin untuk kendaraan kesayangan Anda.',
            'button_text' => 'Lihat Produk Promo',
            'button_url' => '#produk-promo',
            'whatsapp_number' => '081234567890',
            'whatsapp_message' => 'Halo AutoPart Jaya, saya ingin bertanya mengenai produk yang tersedia.',
            'image' => $assets['hero'],
            'is_active' => true,
        ]);

        PageSection::query()->delete();
        PageSection::create([
            'section_key' => 'about',
            'title' => 'Tentang Kami',
            'content' => 'AutoPart Jaya adalah toko spare part otomotif terpercaya yang menyediakan berbagai kebutuhan spare part dan aksesoris kendaraan. Kami hanya menjual produk berkualitas dengan harga bersaing, didukung tenaga profesional yang siap membantu Anda menemukan spare part yang tepat untuk kendaraan Anda.',
            'image' => $assets['about'],
            'is_active' => true,
        ]);

        $products = [
            [
                'name' => 'Kampas Rem Depan',
                'description' => 'Kampas rem depan berkualitas tinggi dengan daya cengkeram optimal dan awet untuk berkendara yang aman.',
                'normal_price' => 250000,
                'promo_price' => 185000,
                'color' => '#dc2626',
            ],
            [
                'name' => 'Aki Kering 35Ah',
                'description' => 'Aki kering 35Ah dengan teknologi MF (maintenance free), tahan lama dan cocok untuk mobil keluarga.',
                'normal_price' => 750000,
                'promo_price' => 640000,
                'color' => '#2563eb',
            ],
            [
                'name' => 'Busi Iridium',
                'description' => 'Busi iridium dengan pembakaran lebih sempurna, hemat bahan bakar, dan tarikan mesin lebih responsif.',
                'normal_price' => 120000,
                'promo_price' => 89000,
                'color' => '#ea580c',
            ],
            [
                'name' => 'Oli Mesin 1 Liter',
                'description' => null,
                'normal_price' => 95000,
                'promo_price' => 79000,
                'color' => '#16a34a',
            ],
            [
                'name' => 'Filter Oli Universal',
                'description' => 'Filter oli universal dengan daya saring maksimal untuk menjaga kebersihan oli mesin kendaraan Anda.',
                'normal_price' => 85000,
                'promo_price' => 65000,
                'color' => '#7c3aed',
            ],
        ];

        PromoProduct::query()->delete();
        foreach ($products as $index => $product) {
            $name = $product['name'];
            PromoProduct::create([
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name),
                'description' => $product['description'] ?? 'Spare part berkualitas untuk kendaraan Anda dengan harga spesial.',
                'normal_price' => $product['normal_price'],
                'promo_price' => $product['promo_price'],
                'image' => $assets['products'][$index],
                'whatsapp_number' => '081234567890',
                'whatsapp_message' => 'Halo, saya tertarik dengan produk '.$name.'. Apakah produk tersebut masih tersedia?',
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
        }

        $socials = [
            ['platform' => 'instagram', 'url' => 'https://www.instagram.com/autopartjaya', 'sort_order' => 1],
            ['platform' => 'facebook', 'url' => 'https://www.facebook.com/autopartjaya', 'sort_order' => 2],
            ['platform' => 'tiktok', 'url' => 'https://www.tiktok.com/@autopartjaya', 'sort_order' => 3],
            ['platform' => 'youtube', 'url' => 'https://www.youtube.com/@autopartjaya', 'sort_order' => 4],
        ];
        foreach ($socials as $social) {
            $social['icon'] = $social['platform'];
            $social['is_active'] = true;
            SocialLink::create($social);
        }

        ContactSetting::query()->delete();
        ContactSetting::create([
            'store_name' => 'AutoPart Jaya',
            'logo' => $assets['logo'],
            'address' => 'Jl. Raya Otomotif No. 88, Jakarta Selatan, DKI Jakarta',
            'phone' => '+62 812 3456 7890',
            'whatsapp' => '081234567890',
            'email' => 'cs@autopartjaya.id',
            'opening_hours' => 'Senin - Sabtu: 08.00 - 17.00 WIB',
            'description' => 'Toko spare part dan aksesoris otomotif terpercaya. Spare part asli, harga bersahabat, pelayanan ramah.',
            'copyright' => '© '.date('Y').' AutoPart Jaya. All rights reserved.',
        ]);

        CtaSection::query()->delete();
        CtaSection::create([
            'section_key' => 'cta_product',
            'title' => 'Siap Meningkatkan Motor Anda',
            'description' => 'Hubungi kami sekarang dan tanyakan kebutuhan spare part kendaraan Anda. Tim kami siap membantu.',
            'button_text' => 'Chat Sekarang',
            'whatsapp_number' => '081234567890',
            'whatsapp_message' => 'Halo AutoPart Jaya, saya ingin menanyakan ketersediaan spare part untuk kendaraan saya.',
            'background_image' => $assets['cta'],
            'is_active' => true,
        ]);

        AppSetting::set('site_title', 'AutoPart Jaya - Toko Spare Part Otomotif');
        AppSetting::set('meta_description', 'AutoPart Jaya menyediakan spare part dan aksesoris otomotif mobil & motor berkualitas dengan harga bersahabat. Hubungi kami sekarang via WhatsApp.');
        AppSetting::set('meta_keywords', 'spare part, otomotif, spare part mobil, spare part motor, aksesoris kendaraan, service kendaraan');
        AppSetting::set('favicon', $assets['favicon']);
    }

    /**
     * Buat gambar placeholder SVG yang terlihat profesional.
     *
     * @return array<string, mixed>
     */
    private function makePlaceholderImages(): array
    {
        $baseColors = ['#1e293b', '#334155', '#0f172a', '#475569'];

        $svgs = [
            'logo' => $this->svgLogo(),
            'favicon' => $this->svgFavicon(),
            'hero' => $this->svgHero(),
            'about' => $this->svgAbout(),
            'cta' => $this->svgCta(),
        ];

        foreach (['products' => 5] as $group => $count) {
            $svgs[$group] = [];
            for ($i = 0; $i < $count; $i++) {
                $rotator = ($i % count($baseColors));
                $svgs[$group][] = $this->svgTile($baseColors[$rotator]);
            }
        }

        foreach ($svgs as $key => $content) {
            $paths = is_array($content) ? $content : [$content];
            foreach ($paths as $index => $svg) {
                $file = is_array($content)
                    ? sprintf('%s/%s-%02d.svg', 'seed', $key, $index + 1)
                    : sprintf('%s/%s.svg', 'seed', $key);

                Storage::disk('public')->put($file, $svg);
                if (! is_array($content)) {
                    $svgs[$key] = $file;
                } else {
                    $svgs[$key][$index] = $file;
                }
            }
        }

        return $svgs;
    }

    private function svgWrap(string $body, int $width = 1200, int $height = 600, string $bg = '#0f172a'): string
    {
        $grad = '<defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0" stop-color="'.$bg.'"/><stop offset="1" stop-color="'.($bg === '#0f172a' ? '#475569' : '#0f172a').'"/></linearGradient></defs>';

        return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 '.$width.' '.$height.'">'
            .$grad
            .'<rect width="'.$width.'" height="'.$height.'" fill="url(#g)"/>'
            .$body
            .'</svg>';
    }

    private function svgLogo(): string
    {
        return $this->svgWrap(
            '<circle cx="190" cy="180" r="110" fill="none" stroke="#f59e0b" stroke-width="16"/>'
            .'<circle cx="190" cy="180" r="46" fill="none" stroke="#f59e0b" stroke-width="14"/>'
            .'<path d="M190 70 L190 290 M70 180 L310 180" stroke="#f59e0b" stroke-width="14"/>'
            .'<text x="380" y="200" font-family="Arial, sans-serif" font-size="76" font-weight="bold" fill="#ffffff">AUTOPART</text>'
            .'<text x="382" y="272" font-family="Arial, sans-serif" font-size="52" font-weight="bold" fill="#f59e0b" letter-spacing="8">JAYA</text>',
            900, 360, '#0f172a'
        );
    }

    private function svgFavicon(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64">'
            .'<circle cx="32" cy="32" r="31" fill="#0f172a" stroke="#f59e0b" stroke-width="2"/>'
            .'<circle cx="32" cy="32" r="14" fill="none" stroke="#f59e0b" stroke-width="5"/>'
            .'<path d="M32 18 L32 46 M18 32 L46 32" stroke="#f59e0b" stroke-width="5"/>'
            .'</svg>';
    }

    private function svgHero(): string
    {
        $pattern = '';
        for ($i = 0; $i < 7; $i++) {
            $x = 120 + $i * 160;
            $pattern .= '<g transform="translate('.$x.',168)"><circle r="46" fill="none" stroke="#f59e0b" stroke-width="6"/>'
                .'<circle r="18" fill="none" stroke="#f59e0b" stroke-width="5"/>'
                .'<path d="M0 -46 L0 46 M-46 0 L46 0" stroke="#f59e0b" stroke-width="5"/></g>';
        }

        return $this->svgWrap($pattern, 1200, 600, '#0f172a');
    }

    private function svgAbout(): string
    {
        return $this->svgWrap(
            '<rect x="520" y="140" width="560" height="320" rx="28" fill="#1e293b" opacity="0.55"/>'
            .'<circle cx="560" cy="560" r="120" fill="#f59e0b" opacity="0.18"/>',
            1200, 700, '#111827'
        );
    }

    private function svgCta(): string
    {
        return $this->svgWrap(
            '<circle cx="300" cy="300" r="180" fill="#f59e0b" opacity="0.16"/>'
            .'<circle cx="900" cy="420" r="120" fill="#f59e0b" opacity="0.14"/>',
            1200, 500, '#0f172a'
        );
    }

    private function svgTile(string $color): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">'
            .'<rect width="800" height="600" fill="'.$color.'"/>'
            .'<circle cx="400" cy="300" r="140" fill="none" stroke="#ffffff" stroke-width="12" opacity="0.85"/>'
            .'<circle cx="400" cy="300" r="52" fill="none" stroke="#ffffff" stroke-width="12" opacity="0.85"/>'
            .'<path d="M400 160 L400 440 M260 300 L540 300" stroke="#ffffff" stroke-width="12" opacity="0.85"/>'
            .'<rect x="250" y="440" width="300" height="46" rx="10" fill="#ffffff" opacity="0.18"/>'
            .'</svg>';
    }
}