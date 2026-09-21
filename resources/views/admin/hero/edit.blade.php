@extends('admin.layouts.app')
@section('title', 'Hero Banner')

@section('content')
<div class="page-head">
    <h2 class="page-head__title">Hero Banner</h2>
    <p class="page-head__sub">Atur gambar, teks, tombol, dan nomor WhatsApp pada hero section.</p>
</div>

<div class="panel">
    <div class="panel__body">
        <form method="POST" action="{{ route('admin.hero.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group form-group--wide">
                    <label for="title" class="form-label">Judul Utama <span class="req">*</span></label>
                    <input type="text" id="title" name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $hero->title) }}" required>
                    @error('title')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label for="subtitle" class="form-label">Subjudul</label>
                    <textarea id="subtitle" name="subtitle" rows="3"
                              class="form-control @error('subtitle') is-invalid @enderror">{{ old('subtitle', $hero->subtitle) }}</textarea>
                    @error('subtitle')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="button_text" class="form-label">Teks Tombol (contoh: Lihat Produk Promo)</label>
                    <input type="text" id="button_text" name="button_text"
                           class="form-control @error('button_text') is-invalid @enderror"
                           value="{{ old('button_text', $hero->button_text) }}">
                    @error('button_text')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="button_url" class="form-label">Link Tombol</label>
                    <input type="url" id="button_url" name="button_url"
                           class="form-control @error('button_url') is-invalid @enderror"
                           placeholder="https://... atau #produk-promo"
                           value="{{ old('button_url', $hero->button_url) }}">
                    @error('button_url')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="whatsapp_number" class="form-label">Nomor WhatsApp (contoh: 081234567890)</label>
                    <input type="text" id="whatsapp_number" name="whatsapp_number"
                           class="form-control @error('whatsapp_number') is-invalid @enderror"
                           value="{{ old('whatsapp_number', $hero->whatsapp_number) }}">
                    @error('whatsapp_number')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="whatsapp_message" class="form-label">Pesan WhatsApp</label>
                    <textarea id="whatsapp_message" name="whatsapp_message" rows="3"
                              class="form-control @error('whatsapp_message') is-invalid @enderror">{{ old('whatsapp_message', $hero->whatsapp_message) }}</textarea>
                    @error('whatsapp_message')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label class="form-label">Gambar Hero</label>
                    <div class="image-field">
                        <div class="image-field__preview">
                            @if (! empty($hero->image))
                                <img src="{{ asset('storage/'.$hero->image) }}" alt="Pratinjau hero" class="image-field__img">
                            @else
                                <span class="image-field__empty">Belum ada gambar</span>
                            @endif
                        </div>
                        <div class="image-field__controls">
                            <input type="file" id="image" name="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/webp">
                            <p class="form-hint">Format: jpg, jpeg, png, webp. Maks 2MB.</p>
                            @error('image')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group form-group--wide">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $hero->is_active) ? 'checked' : '' }}>
                        <span>Tampilkan hero banner</span>
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection