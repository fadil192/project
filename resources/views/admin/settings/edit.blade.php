@extends('admin.layouts.app')
@section('title', 'Pengaturan')

@section('content')
<div class="page-head">
    <h2 class="page-head__title">Pengaturan Website</h2>
    <p class="page-head__sub">Atur title, meta description, meta keywords, dan favicon untuk SEO.</p>
</div>

<div class="panel">
    <div class="panel__body">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group form-group--wide">
                    <label for="site_title" class="form-label">Judul Website <span class="req">*</span></label>
                    <input type="text" id="site_title" name="site_title"
                           class="form-control @error('site_title') is-invalid @enderror"
                           value="{{ old('site_title', $siteTitle) }}" required>
                    @error('site_title')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3"
                              class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $metaDescription) }}</textarea>
                    @error('meta_description')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" id="meta_keywords" name="meta_keywords"
                           class="form-control @error('meta_keywords') is-invalid @enderror"
                           value="{{ old('meta_keywords', $metaKeywords) }}"
                           placeholder="spare part, otomotif, aksesoris kendaraan">
                    @error('meta_keywords')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label class="form-label">Favicon</label>
                    <div class="image-field">
                        <div class="image-field__preview image-field__preview--small">
                            @if (! empty($favicon))
                                <img src="{{ asset('storage/'.$favicon) }}" alt="Favicon" class="image-field__img image-field__img--square">
                            @else
                                <span class="image-field__empty">Belum ada favicon</span>
                            @endif
                        </div>
                        <div class="image-field__controls">
                            <input type="file" id="favicon" name="favicon"
                                   class="form-control @error('favicon') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/webp,image/svg+xml,image/x-icon">
                            <p class="form-hint">Format: jpg, jpeg, png, webp, svg, ico. Maks 1MB. Gambar kotak disarankan (mis. 64x64).</p>
                            @error('favicon')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection