@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--primary"><x-svg-icon name="car"/></div>
        <div class="stat-card__meta">
            <span class="stat-card__value">{{ $totalProducts }}</span>
            <span class="stat-card__label">Total Produk Promo</span>
            <span class="stat-card__sub">{{ $activeProducts }} aktif</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--blue"><x-svg-icon name="instagram"/></div>
        <div class="stat-card__meta">
            <span class="stat-card__value">{{ $totalSocials }}</span>
            <span class="stat-card__label">Total Social Media</span>
            <span class="stat-card__sub">{{ $activeSocials }} aktif</span>
        </div>
    </div>
</div>

<div class="panel-grid">
    <div class="panel">
        <div class="panel__head">
            <h3 class="panel__title">Status Hero Banner</h3>
            <a href="{{ route('admin.hero.edit') }}" class="btn btn--primary btn--sm">Edit</a>
        </div>
        <div class="panel__body">
            @if ($hero)
                <p class="panel__text"><strong>{{ $hero->title }}</strong></p>
                <p class="panel__text panel__text--muted">{{ Str::limit($hero->subtitle, 90) }}</p>
                <span class="badge {{ $hero->is_active ? 'badge--success' : 'badge--danger' }}">
                    {{ $hero->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            @else
                <p class="panel__text panel__text--muted">Belum ada data hero. Tambahkan melalui menu Hero Banner.</p>
            @endif
        </div>
    </div>

    <div class="panel">
        <div class="panel__head">
            <h3 class="panel__title">Status Landing Page</h3>
            <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="btn btn--primary btn--sm">Lihat</a>
        </div>
        <div class="panel__body">
            <div class="status-list">
                <div class="status-item">
                    <span>Tentang Kami</span>
                    <span class="badge {{ $aboutSection?->is_active ? 'badge--success' : 'badge--danger' }}">
                        {{ $aboutSection?->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
                <div class="status-item">
                    <span>CTA Produk</span>
                    <span class="badge {{ $ctaProduct?->is_active ? 'badge--success' : 'badge--danger' }}">
                        {{ $ctaProduct?->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection