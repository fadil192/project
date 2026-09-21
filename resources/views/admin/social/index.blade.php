@extends('admin.layouts.app')
@section('title', 'Social Media')

@section('content')
<div class="page-head page-head--between">
    <div>
        <h2 class="page-head__title">Social Media</h2>
        <p class="page-head__sub">Kelola link media sosial toko. Link yang nonaktif tidak ditampilkan.</p>
    </div>
</div>

<div class="panel">
    <div class="panel__body">
        <div class="panel__head" style="margin-bottom: 18px;">
            <h3 class="panel__title">Tambah Link Baru</h3>
        </div>

        <form method="POST" action="{{ route('admin.social.store') }}">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="platform" class="form-label">Platform</label>
                    <select id="platform" name="platform" class="form-control @error('platform') is-invalid @enderror">
                        <option value="">-- Pilih platform --</option>
                        @foreach ($platforms as $platform)
                            <option value="{{ $platform }}" {{ old('platform') === $platform ? 'selected' : '' }}>{{ ucfirst($platform) }}</option>
                        @endforeach
                    </select>
                    @error('platform')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--grow">
                    <label for="url" class="form-label">URL</label>
                    <input type="url" id="url" name="url"
                           class="form-control @error('url') is-invalid @enderror"
                           placeholder="https://instagram.com/namatoko"
                           value="{{ old('url') }}">
                    @error('url')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order" min="0"
                           class="form-control" value="{{ old('sort_order', 0) }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn--primary" style="margin-top: 28px;">
                        <x-svg-icon name="plus" class="btn__icon"/>Tambah
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Platform</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($socials as $social)
                    <tr>
                        <td>{{ $social->sort_order }}</td>
                        <td>
                            <span class="platform-cell">
                                @if (in_array($social->platform, ['instagram', 'facebook', 'tiktok', 'youtube'], true))
                                    <x-svg-icon name="{{ $social->platform }}" class="platform-cell__icon"/>
                                @endif
                                {{ ucfirst($social->platform) }}
                            </span>
                        </td>
                        <td><a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer" class="text-primary">{{ Str::limit($social->url, 45) }}</a></td>
                        <td>
                            <form method="POST" action="{{ route('admin.social.toggle', $social) }}" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="badge btn-reset {{ $social->is_active ? 'badge--success' : 'badge--danger' }}">
                                    {{ $social->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-right">
                            <div class="table-actions">
                                <a href="{{ route('admin.social.edit', $social) }}" class="btn btn--primary btn--sm">Edit</a>
                                <form method="POST" action="{{ route('admin.social.destroy', $social) }}" data-confirm="Yakin ingin menghapus link {{ $social->platform }}?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn--danger btn--sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">Belum ada link sosial media.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection