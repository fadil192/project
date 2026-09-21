@extends('admin.layouts.app')
@section('title', 'Edit Produk')

@section('content')
<div class="page-head">
    <h2 class="page-head__title">Edit Produk: {{ $product->name }}</h2>
    <p class="page-head__sub">Ubah informasi produk promo ini.</p>
</div>

<div class="panel">
    <div class="panel__body">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.products._form', ['product' => $product])
        </form>
    </div>
</div>
@endsection