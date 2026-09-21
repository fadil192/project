@php
    $edit = isset($product) && $product->exists;
@endphp

<div class="form-grid">
    <div class="form-group">
        <label for="name" class="form-label">Nama Produk <span class="req">*</span></label>
        <input type="text" id="name" name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $edit ? $product->name : '') }}" required>
        @error('name')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="slug" class="form-label">Slug (opsional)</label>
        <input type="text" id="slug" name="slug"
               class="form-control @error('slug') is-invalid @enderror"
               value="{{ old('slug', $edit ? $product->slug : '') }}" placeholder="otomatis dari nama">
        <p class="form-hint">Kosongkan untuk generate otomatis.</p>
        @error('slug')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group form-group--wide">
        <label for="description" class="form-label">Deskripsi Singkat</label>
        <textarea id="description" name="description" rows="4"
                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $edit ? $product->description : '') }}</textarea>
        @error('description')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="normal_price" class="form-label">Harga Normal (Rp)</label>
        <input type="number" id="normal_price" name="normal_price" step="0.01" min="0"
               class="form-control @error('normal_price') is-invalid @enderror"
               value="{{ old('normal_price', $edit ? $product->normal_price : '') }}"
               placeholder="contoh: 250000">
        @error('normal_price')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="promo_price" class="form-label">Harga Promo (Rp)</label>
        <input type="number" id="promo_price" name="promo_price" step="0.01" min="0"
               class="form-control @error('promo_price') is-invalid @enderror"
               value="{{ old('promo_price', $edit ? $product->promo_price : '') }}"
               placeholder="contoh: 185000">
        @error('promo_price')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="whatsapp_number" class="form-label">Nomor WhatsApp</label>
        <input type="text" id="whatsapp_number" name="whatsapp_number"
               class="form-control @error('whatsapp_number') is-invalid @enderror"
               value="{{ old('whatsapp_number', $edit ? $product->whatsapp_number : '') }}"
               placeholder="081234567890">
        @error('whatsapp_number')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="whatsapp_message" class="form-label">Pesan WhatsApp</label>
        <textarea id="whatsapp_message" name="whatsapp_message" rows="3"
                  class="form-control @error('whatsapp_message') is-invalid @enderror">{{ old('whatsapp_message', $edit ? $product->whatsapp_message : '') }}</textarea>
        <p class="form-hint">Contoh otomatis: "Halo, saya tertarik dengan produk [NAMA PRODUK]. Apakah produk tersebut masih tersedia?"</p>
        @error('whatsapp_message')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="sort_order" class="form-label">Urutan Tampil</label>
        <input type="number" id="sort_order" name="sort_order" min="0"
               class="form-control @error('sort_order') is-invalid @enderror"
               value="{{ old('sort_order', $edit ? $product->sort_order : 0) }}">
        @error('sort_order')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group form-group--wide">
        <label class="form-label">Gambar Produk</label>
        <div class="image-field">
            <div class="image-field__preview">
                @if ($edit && ! empty($product->image))
                    <img src="{{ asset('storage/'.$product->image) }}" alt="Pratinjau" class="image-field__img">
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

    <div class="form-group form-group--wide">
        <label class="form-check">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $edit ? $product->is_active : true) ? 'checked' : '' }}>
            <span>Tampilkan produk ini</span>
        </label>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.products.index') }}" class="btn btn--ghost">Batal</a>
    <button type="submit" class="btn btn--primary">{{ $edit ? 'Simpan Perubahan' : 'Tambah Produk' }}</button>
</div>