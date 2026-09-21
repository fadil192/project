<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CtaSection;
use App\Models\Hero;
use App\Models\PageSection;
use App\Models\PromoProduct;
use App\Models\SocialLink;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $data = [
            'totalProducts' => PromoProduct::count(),
            'activeProducts' => PromoProduct::where('is_active', true)->count(),
            'totalSocials' => SocialLink::count(),
            'activeSocials' => SocialLink::where('is_active', true)->count(),
            'hero' => Hero::query()->orderBy('id')->first(),
            'aboutSection' => PageSection::where('section_key', 'about')->first(),
            'ctaProduct' => CtaSection::where('section_key', 'cta_product')->first(),
        ];

        return view('admin.dashboard.index', $data);
    }
}