@extends('admin.layouts.app')
@section('title', 'CTA WhatsApp')

@section('content')
<div class="page-head">
    <h2 class="page-head__title">CTA WhatsApp</h2>
    <p class="page-head__sub">Kelola section ajakan (call to action) menuju WhatsApp.</p>
</div>

<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Judul</th>
                    <th>Posisi</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ctas as $cta)
                    <tr>
                        <td><code>{{ $cta->section_key }}</code></td>
                        <td>{{ $cta->title }}</td>
                        <td>Setelah Produk Promo</td>
                        <td>
                            <span class="badge {{ $cta->is_active ? 'badge--success' : 'badge--danger' }}">
                                {{ $cta->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.cta.edit', $cta) }}" class="btn btn--primary btn--sm">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">Belum ada data CTA.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection