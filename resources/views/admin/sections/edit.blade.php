@extends('admin.layouts.app')
@section('title', 'Edit Section')

@section('content')
<div class="page-head">
    <h2 class="page-head__title">Edit Section: {{ $section->section_key }}</h2>
    <p class="page-head__sub">Ubah judul, isi konten, dan gambar section ini.</p>
</div>

<div class="panel">
    <div class="panel__body">
        <form method="POST" action="{{ route('admin.sections.update', $section) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="form-label">Judul <span class="req">*</span></label>
                <input type="text" id="title" name="title"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $section->title) }}" required>
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Isi Konten <span class="req">*</span></label>
                <textarea id="content" name="content" rows="8"
                          class="form-control @error('content') is-invalid @enderror"
                          required>{{ old('content', $section->content) }}</textarea>
                <p class="form-hint">Baris baru akan ditampilkan sebagai paragraf baru.</p>
                @error('content')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Gambar</label>
                <div class="image-field">
                    <div class="image-field__preview">
                        @if (! empty($section->image))
                            <img src="{{ asset('storage/'.$section->image) }}" alt="Pratinjau" class="image-field__img image-field__img--square">
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

            <div class="form-group">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $section->is_active) ? 'checked' : '' }}>
                    <span>Tampilkan section ini</span>
                </label>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.sections.index') }}" class="btn btn--ghost">Batal</a>
                <button type="submit" class="btn btn--primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection