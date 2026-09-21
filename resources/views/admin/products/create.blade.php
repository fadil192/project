@extends('admin.layouts.app')
@section('title', 'Tambah Produk')

@section('content')
<div class="page-head">
    <h2 class="page-head__title">Tambah Produk Promo</h2>
    <p class="page-head__sub">Lengkapi informasi produk yang ingin dipromosikan.</p>
</div>

<div class="panel">
    <div class="panel__body">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.products._form', ['product' => new \App\Models\PromoProduct()])
        </form>
    </div>
</div>
@endsection