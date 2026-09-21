<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\ContactSetting;
use App\Models\CtaSection;
use App\Models\Hero;
use App\Models\PageSection;
use App\Models\PromoProduct;
use App\Models\SocialLink;

class LandingController extends Controller
{
    public function index()
    {
        $setting = ContactSetting::query()->orderBy('id')->first() ?? new ContactSetting();

        $seo = [
            'site_title' => AppSetting::get('site_title', $setting->store_name ?: 'AutoPart Jaya'),
            'meta_description' => AppSetting::get('meta_description'),
            'meta_keywords' => AppSetting::get('meta_keywords'),
            'favicon' => AppSetting::get('favicon'),
        ];

        $data = [
            'setting' => $setting,
            'seo' => $seo,
            'hero' => Hero::query()->active()->orderBy('id')->first(),
            'about' => PageSection::where('section_key', 'about')->where('is_active', true)->first(),
            'products' => PromoProduct::active()->ordered()->get(),
            'ctaProduct' => CtaSection::where('section_key', 'cta_product')->where('is_active', true)->first(),
            'socials' => SocialLink::active()->ordered()->get(),
        ];

        return view('landing', $data);
    }
}