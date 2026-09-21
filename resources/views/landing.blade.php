<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seo['site_title'] ?: config('app.name') }}</title>

    @if (! empty($seo['meta_description']))
        <meta name="description" content="{{ $seo['meta_description'] }}">
    @endif
    @if (! empty($seo['meta_keywords']))
        <meta name="keywords" content="{{ $seo['meta_keywords'] }}">
    @endif

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seo['site_title'] ?: config('app.name') }}">
    @if (! empty($seo['meta_description']))
        <meta property="og:description" content="{{ $seo['meta_description'] }}">
    @endif
    @if (! empty($hero?->image))
        <meta property="og:image" content="{{ asset('storage/'.$hero->image) }}">
    @endif
    <meta property="og:site_name" content="{{ $setting->store_name ?? config('app.name') }}">

    <link rel="icon" type="{{ App\Models\AppSetting::get('favicon') ? 'image/svg+xml' : 'image/x-icon' }}" href="{{ ! empty($seo['favicon']) ? asset('storage/'.$seo['favicon']) : asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>


    <main>
        @include('partials.hero')
        @include('partials.about')
        @include('partials.products')
        @include('partials.cta-product')
        @include('partials.social')
    </main>

    @include('partials.contact')

    <a href="{{ wa_link($setting->whatsapp ?? '', 'Halo '.($setting->store_name ?? 'toko').', saya ingin bertanya.') }}"
       class="wa-float" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
        <x-svg-icon name="whatsapp" class="wa-float__icon"/>
    </a>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>