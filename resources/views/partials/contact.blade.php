<footer class="footer" id="hubungi-kami">
    <div class="container">
        <div class="footer__grid">
            <div class="footer__col footer__col--brand">
                <a href="{{ route('home') }}" class="footer__brand">
                    @if (! empty($setting->logo))
                        <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo {{ $setting->store_name }}" class="footer__logo">
                    @else
                        <span class="footer__logo-fallback"><x-svg-icon name="gear"/></span>
                    @endif
                    <span class="footer__name">{{ $setting->store_name ?? '' }}</span>
                </a>

                @if (! empty($setting->description))
                    <p class="footer__desc">{{ $setting->description }}</p>
                @endif

            </div>

            <div class="footer__col">
                <h4 class="footer__heading">Kontak</h4>
                <ul class="footer__list">
                    @if (! empty($setting->address))
                        <li class="footer__item">
                            <x-svg-icon name="map-pin" class="footer__item-icon"/>
                            <span>{{ $setting->address }}</span>
                        </li>
                    @endif
                    @if (! empty($setting->whatsapp))
                        <li class="footer__item">
                            <x-svg-icon name="whatsapp" class="footer__item-icon"/>
                            <a href="{{ wa_link($setting->whatsapp) }}" target="_blank" rel="noopener noreferrer">{{ $setting->whatsapp }}</a>
                        </li>
                    @endif
                    @if (! empty($setting->phone))
                        <li class="footer__item">
                            <x-svg-icon name="phone" class="footer__item-icon"/>
                            <a href="tel:{{ preg_replace('/\D/', '', $setting->phone) }}">{{ $setting->phone }}</a>
                        </li>
                    @endif
                    @if (! empty($setting->email))
                        <li class="footer__item">
                            <x-svg-icon name="mail" class="footer__item-icon"/>
                            <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                        </li>
                    @endif
                    @if (! empty($setting->opening_hours))
                        <li class="footer__item">
                            <x-svg-icon name="clock" class="footer__item-icon"/>
                            <span>{{ $setting->opening_hours }}</span>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="footer__col">
                <h4 class="footer__heading">PRODUK & SERVIS</h4>
                <ul class="footer__list">
                    <li class="footer__item"><a href="#">Oli Motor (4T, Matic)</a></li>
                    <li class="footer__item"><a href="#produk-promo">Gear Oil</a></li>
                    <li class="footer__item"><a href="#tentang-kami">Servis</a></li>
                    <li class="footer__item"><a href="#ikuti-kami">Ganti Oli</a></li>
                </ul>
            </div>
            
        </div>

        <div class="footer__social">
            @foreach ($socials as $social)
                @if (in_array($social->platform, ['instagram', 'facebook', 'tiktok', 'youtube'], true))
                    <a href="{{ $social->url }}" class="footer__social-link footer__social-link--{{ $social->platform }}"
                       target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($social->platform) }}">
                        <x-svg-icon name="{{ $social->platform }}"/>
                    </a>
                @endif
            @endforeach
        </div>

        <div class="footer__bottom">
            <p>{{ $setting->copyright ?: '© '.date('Y').' '.($setting->store_name ?? 'Toko').'. All rights reserved.' }}</p>
        </div>
    </div>
</footer>