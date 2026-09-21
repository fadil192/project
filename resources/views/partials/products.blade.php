@if ($products->isNotEmpty())
<section class="section" id="produk-promo">
    <div class="container">
        <div class="section__head">
            <span class="eyebrow">Penawaran Spesial</span>
            <h2 class="section__title">Produk Promo</h2>
            <p class="section__lead">Dapatkan spare part berkualitas dengan harga spesial selama periode promo.</p>
        </div>

        <div class="product-grid">
            @foreach ($products as $product)
                <article class="product-card">
                    <div class="product-card__media">
                        @if (! empty($product->image))
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="product-card__image" loading="lazy">
                        @else
                            <div class="product-card__image product-card__image--empty">
                                <x-svg-icon name="gear"/>
                            </div>
                        @endif

                        @if ($product->promo_price && $product->normal_price > $product->promo_price)
                            <span class="product-card__badge">
                                -{{ round((1 - $product->promo_price / $product->normal_price) * 100) }}%
                            </span>
                        @endif
                    </div>

                    <div class="product-card__body">
                        <h3 class="product-card__title">{{ $product->name }}</h3>

                        @if (! empty($product->description))
                            <p class="product-card__desc">{{ $product->description }}</p>
                        @endif

                        <a href="{{ wa_link($product->whatsapp_number ?: $setting->whatsapp, $product->getWaMessage()) }}"
                           class="btn btn--red btn--block"
                           target="_blank" rel="noopener noreferrer">
                            <x-svg-icon name="whatsapp" class="btn__icon"/>
                            Chat Sekarang
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif