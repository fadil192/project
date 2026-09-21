@extends('admin.layouts.app')
@section('title', 'Produk Promo')

@section('content')
<div class="page-head page-head--between">
    <div>
        <h2 class="page-head__title">Produk Promo</h2>
        <p class="page-head__sub">Kelola produk promosi yang ditampilkan di landing page.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn--primary">
        <x-svg-icon name="plus" class="btn__icon"/>Tambah Produk
    </a>
</div>

<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->sort_order }}</td>
                        <td>
                            @if (! empty($product->image))
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="table__thumb">
                            @else
                                <span class="table__thumb table__thumb--empty">-</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $product->name }}</strong>
                            <br><small class="text-muted">{{ $product->slug }}</small>
                        </td>
                        <td>
                            @if ($product->normal_price)
                                <span class="text-strike">{{ rupiah($product->normal_price) }}</span><br>
                            @endif
                            @if ($product->promo_price)
                                <strong class="text-primary">{{ rupiah($product->promo_price) }}</strong>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.products.toggle', $product) }}" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="badge btn-reset {{ $product->is_active ? 'badge--success' : 'badge--danger' }}">
                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-right">
                            <div class="table-actions">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn--primary btn--sm">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" data-confirm="Yakin ingin menghapus produk {{ $product->name }}?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn--danger btn--sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            Belum ada produk promo.
                            <a href="{{ route('admin.products.create') }}" class="text-primary">Tambah sekarang</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($products->hasPages())
        <div class="pagination-wrap">{{ $products->links() }}</div>
    @endif
</div>
@endsection