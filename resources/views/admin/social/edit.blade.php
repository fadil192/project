@extends('admin.layouts.app')
@section('title', 'Edit Social Media')

@section('content')
<div class="page-head">
    <h2 class="page-head__title">Edit Link: {{ ucfirst($social->platform) }}</h2>
    <p class="page-head__sub">Ubah link media sosial ini.</p>
</div>

<div class="panel">
    <div class="panel__body">
        <form method="POST" action="{{ route('admin.social.update', $social) }}">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="platform" class="form-label">Platform</label>
                    <select id="platform" name="platform" class="form-control @error('platform') is-invalid @enderror">
                        @foreach ($platforms as $platform)
                            <option value="{{ $platform }}" {{ old('platform', $social->platform) === $platform ? 'selected' : '' }}>{{ ucfirst($platform) }}</option>
                        @endforeach
                    </select>
                    @error('platform')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order" min="0"
                           class="form-control @error('sort_order') is-invalid @enderror"
                           value="{{ old('sort_order', $social->sort_order) }}">
                    @error('sort_order')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label for="url" class="form-label">URL <span class="req">*</span></label>
                    <input type="url" id="url" name="url"
                           class="form-control @error('url') is-invalid @enderror"
                           value="{{ old('url', $social->url) }}" required>
                    @error('url')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $social->is_active) ? 'checked' : '' }}>
                        <span>Tampilkan link ini</span>
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.social.index') }}" class="btn btn--ghost">Batal</a>
                <button type="submit" class="btn btn--primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection