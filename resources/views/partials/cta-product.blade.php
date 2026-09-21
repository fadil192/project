@if ($ctaProduct)
<section class="cta cta--product" id="cta-produk" @if (! empty($ctaProduct->background_image)) style="background-image: url('{{ asset('storage/'.$ctaProduct->background_image) }}')" @endif>
    <div class="cta__overlay"></div>
    <div class="container cta__content">
        <h2 class="cta__title">{{ $ctaProduct->title }}</h2>
        @if (! empty($ctaProduct->description))
            <p class="cta__text">{{ $ctaProduct->description }}</p>
        @endif

        <div class="cta__btns">
            <a href="#" class="btn btn--red">Belanja Grosir</a>
            <a href="#" class="btn btn--primary" style="background-color: #ffffff; color: #000000; border-color: #ffffff;">Belanja Satuan</a>
            <a href="#" class="btn btn--primary" style="background-color: #ffffff; color: #000000; border-color: #ffffff;">Pesan Servis</a>
        </div>

        @if (! empty($ctaProduct->whatsapp_number))
            <a href="{{ wa_link($ctaProduct->whatsapp_number, $ctaProduct->whatsapp_message) }}"
               class="btn btn--red btn--lg"
               target="_blank" rel="noopener noreferrer">
                <x-svg-icon name="whatsapp" class="btn__icon"/>
                {{ $ctaProduct->button_text ?: 'Chat Sekarang' }}
            </a>
        @endif
    </div>
</section>
@endif