@if ($hero)
<section class="hero" id="home">
    @if (! empty($hero->image))
        <div class="hero__bg">
            <img src="{{ asset('storage/'.$hero->image) }}" alt="{{ $hero->title }}" class="hero__bg-img">
        </div>
    @endif
    <div class="hero__overlay"></div>

    <div class="container hero__content">
        <span class="hero__badge">
            <x-svg-icon name="check" class="hero__badge-icon"/>
            Spare Part Asli &amp; Terpercaya
        </span>

        <h1 class="hero__title">{{ $hero->title }}</h1>

        @if (! empty($hero->subtitle))
            <p class="hero__subtitle">{{ $hero->subtitle }}</p>
        @endif

    </div>
</section>
@endif