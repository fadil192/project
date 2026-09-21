@extends('admin.layouts.app')
@section('title', 'Tentang Kami')

@section('content')
<div class="page-head">
    <h2 class="page-head__title">Konten Section</h2>
    <p class="page-head__sub">Kelola konten teks landing page seperti "Tentang Kami".</p>
</div>

<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Section</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sections as $section)
                    <tr>
                        <td><code>{{ $section->section_key }}</code></td>
                        <td>{{ $section->title }}</td>
                        <td>
                            <span class="badge {{ $section->is_active ? 'badge--success' : 'badge--danger' }}">
                                {{ $section->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.sections.edit', $section) }}" class="btn btn--primary btn--sm">
                                <x-svg-icon name="pencil" class="btn__icon"/>Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty-state">Belum ada section. Jalankan seeder atau tambahkan data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection