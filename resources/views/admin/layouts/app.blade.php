<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body">

    <div class="admin">
        <aside class="sidebar" data-sidebar>
            <div class="sidebar__brand">
                <span class="sidebar__logo"><x-svg-icon name="gear"/></span>
                <div class="sidebar__brand-text">
                    <strong>Ledeng Motor</strong>
                    <small>Admin Panel</small>
                </div>
            </div>

            <nav class="sidebar__nav">
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar__link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                    <x-svg-icon name="gear" class="sidebar__link-icon"/>Dashboard
                </a>
                <a href="{{ route('admin.hero.edit') }}"
                   class="sidebar__link {{ request()->routeIs('admin.hero.*') ? 'is-active' : '' }}">
                    <x-svg-icon name="wrench" class="sidebar__link-icon"/>Hero Banner
                </a>
                <a href="{{ route('admin.sections.index') }}"
                   class="sidebar__link {{ request()->routeIs('admin.sections.*') ? 'is-active' : '' }}">
                    <x-svg-icon name="chat" class="sidebar__link-icon"/>Tentang Kami
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="sidebar__link {{ request()->routeIs('admin.products.*') ? 'is-active' : '' }}">
                    <x-svg-icon name="car" class="sidebar__link-icon"/>Produk Promo
                </a>
                <a href="{{ route('admin.cta.index') }}"
                   class="sidebar__link {{ request()->routeIs('admin.cta.*') ? 'is-active' : '' }}">
                    <x-svg-icon name="arrow-right" class="sidebar__link-icon"/>CTA WhatsApp
                </a>
                <a href="{{ route('admin.social.index') }}"
                   class="sidebar__link {{ request()->routeIs('admin.social.*') ? 'is-active' : '' }}">
                    <x-svg-icon name="instagram" class="sidebar__link-icon"/>Social Media
                </a>
                <a href="{{ route('admin.contact.edit') }}"
                   class="sidebar__link {{ request()->routeIs('admin.contact.*') ? 'is-active' : '' }}">
                    <x-svg-icon name="phone" class="sidebar__link-icon"/>Kontak &amp; Footer
                </a>
                <a href="{{ route('admin.settings.edit') }}"
                   class="sidebar__link {{ request()->routeIs('admin.settings.*') ? 'is-active' : '' }}">
                    <x-svg-icon name="check" class="sidebar__link-icon"/>Pengaturan
                </a>
            </nav>

            <div class="sidebar__footer">
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="sidebar__btn">
                    <x-svg-icon name="external" class="sidebar__link-icon"/>Lihat Website
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="sidebar__btn sidebar__btn--danger">
                        <x-svg-icon name="close" class="sidebar__link-icon"/>Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="admin__main">
            <header class="topbar">
                <button class="topbar__toggle" type="button" data-sidebar-toggle aria-label="Buka/tutup menu">
                    <x-svg-icon name="menu" class="topbar__toggle-icon"/>
                </button>
                <h1 class="topbar__title">{{ $title ?? 'Dashboard' }}</h1>
                <div class="topbar__user">
                    <span class="topbar__user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    <span class="topbar__user-name">{{ auth()->user()->name }}</span>
                </div>
            </header>

            <main class="content">
                @if (session('success'))
                    <div class="alert alert--success" role="alert">
                        <x-svg-icon name="check" class="alert__icon"/>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="alert__close" data-alert-close aria-label="Tutup">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert--error" role="alert">
                        <x-svg-icon name="close" class="alert__icon"/>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="alert__close" data-alert-close aria-label="Tutup">&times;</button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert--error" role="alert">
                        <x-svg-icon name="close" class="alert__icon"/>
                        <div class="alert__list">
                            <strong>Periksa kembali isian Anda:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="alert__close" data-alert-close aria-label="Tutup">&times;</button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <div class="sidebar-backdrop" data-sidebar-backdrop></div>

    <script src="{{ asset('js/admin.js') }}" defer></script>
</body>
</html>