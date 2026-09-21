@extends('admin.layouts.app')
@section('title', 'Edit CTA')

@section('content')
<div class="page-head">
    <h2 class="page-head__title">Edit CTA: {{ $cta->section_key }}</h2>
    <p class="page-head__sub">Ubah ajakan WhatsApp pada posisi ini.</p>
</div>

<div class="panel">
    <div class="panel__body">
        <form method="POST" action="{{ route('admin.cta.update', $cta) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group form-group--wide">
                    <label for="title" class="form-label">Judul <span class="req">*</span></label>
                    <input type="text" id="title" name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $cta->title) }}" required>
                    @error('title')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label for="description" class="form-label">Teks</label>
                    <textarea id="description" name="description" rows="3"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $cta->description) }}</textarea>
                    @error('description')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="button_text" class="form-label">Teks Tombol</label>
                    <input type="text" id="button_text" name="button_text"
                           class="form-control @error('button_text') is-invalid @enderror"
                           value="{{ old('button_text', $cta->button_text) }}">
                    @error('button_text')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="whatsapp_number" class="form-label">Nomor WhatsApp</label>
                    <input type="text" id="whatsapp_number" name="whatsapp_number"
                           class="form-control @error('whatsapp_number') is-invalid @enderror"
                           value="{{ old('whatsapp_number', $cta->whatsapp_number) }}">
                    @error('whatsapp_number')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label for="whatsapp_message" class="form-label">Pesan WhatsApp</label>
                    <textarea id="whatsapp_message" name="whatsapp_message" rows="3"
                              class="form-control @error('whatsapp_message') is-invalid @enderror">{{ old('whatsapp_message', $cta->whatsapp_message) }}</textarea>
                    @error('whatsapp_message')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label class="form-label">Background Image (opsional)</label>
                    <div class="image-field">
                        <div class="image-field__preview">
                            @if (! empty($cta->background_image))
                                <img src="{{ asset('storage/'.$cta->background_image) }}" alt="Pratinjau" class="image-field__img image-field__img--square">
                            @else
                                <span class="image-field__empty">Belum ada gambar</span>
                            @endif
                        </div>
                        <div class="image-field__controls">
                            <input type="file" id="background_image" name="background_image"
                                   class="form-control @error('background_image') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/webp">
                            <p class="form-hint">Format: jpg, jpeg, png, webp. Maks 2MB.</p>
                            @error('background_image')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group form-group--wide">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $cta->is_active) ? 'checked' : '' }}>
                        <span>Tampilkan CTA ini</span>
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.cta.index') }}" class="btn btn--ghost">Batal</a>
                <button type="submit" class="btn btn--primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection