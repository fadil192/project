<header class="navbar">
    <div class="container navbar__inner">
        <a href="{{ route('home') }}" class="navbar__brand">
            @if (! empty($setting->logo))
                <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo {{ $setting->store_name }}" class="navbar__logo">
            @else
                <span class="navbar__logo-fallback">
                    <x-svg-icon name="gear" class="navbar__logo-fallback-icon"/>
                </span>
            @endif
            <span class="navbar__name">{{ $setting->store_name ?? 'Toko Spare Part' }}</span>
        </a>

        <button class="navbar__toggle" type="button" aria-label="Buka menu" aria-expanded="false" data-nav-toggle>
            <x-svg-icon name="menu" class="navbar__toggle-icon"/>
        </button>

        <nav class="navbar__menu" data-nav-menu>
            <a href="{{ route('home') }}" class="navbar__link">Home</a>
            <a href="#produk-promo" class="navbar__link">Produk Promo</a>
            <a href="#hubungi-kami" class="navbar__link">Hubungi Kami</a>
            <a href="#ikuti-kami" class="navbar__link">Ikuti Kami</a>

            @if (! empty($setting->whatsapp))
                <a href="{{ wa_link($setting->whatsapp, 'Halo '.($setting->store_name ?? 'toko').', saya ingin bertanya.') }}"
                   class="btn btn--wa navbar__cta"
                   target="_blank" rel="noopener noreferrer">
                    <x-svg-icon name="whatsapp" class="btn__icon"/>
                    Chat
                </a>
            @endif
        </nav>
    </div>
</header>