@if ($about)
<section class="section section--light" id="tentang-kami">
    <div class="container">
<div class="about about--text-only">
    <div class="about__body">
                <span class="eyebrow">PILIH KEBUTUHAN ANDA</span>
                <h2 class="section__title">
                    SOLUSI LENGKAP<br>UNTUK ANDA
                </h2>
                <div class="about__content">{!! nl2br(e($about->content)) !!}</div>

            </div>
        </div>
    </div>
</section>
@endif