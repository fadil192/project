@extends('admin.layouts.app')
@section('title', 'Kontak & Footer')

@section('content')
<div class="page-head">
    <h2 class="page-head__title">Kontak &amp; Footer</h2>
    <p class="page-head__sub">Kelola identitas toko, logo, dan informasi kontak pada footer.</p>
</div>

<div class="panel">
    <div class="panel__body">
        <form method="POST" action="{{ route('admin.contact.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="store_name" class="form-label">Nama Toko <span class="req">*</span></label>
                    <input type="text" id="store_name" name="store_name"
                           class="form-control @error('store_name') is-invalid @enderror"
                           value="{{ old('store_name', $contact->store_name) }}" required>
                    @error('store_name')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="whatsapp" class="form-label">Nomor WhatsApp</label>
                    <input type="text" id="whatsapp" name="whatsapp"
                           class="form-control @error('whatsapp') is-invalid @enderror"
                           value="{{ old('whatsapp', $contact->whatsapp) }}" placeholder="081234567890">
                    @error('whatsapp')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label for="description" class="form-label">Deskripsi Singkat</label>
                    <textarea id="description" name="description" rows="3"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $contact->description) }}</textarea>
                    @error('description')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea id="address" name="address" rows="2"
                              class="form-control @error('address') is-invalid @enderror">{{ old('address', $contact->address) }}</textarea>
                    @error('address')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Telepon</label>
                    <input type="text" id="phone" name="phone"
                           class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone', $contact->phone) }}">
                    @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $contact->email) }}">
                    @error('email')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label for="opening_hours" class="form-label">Jam Operasional</label>
                    <input type="text" id="opening_hours" name="opening_hours"
                           class="form-control @error('opening_hours') is-invalid @enderror"
                           value="{{ old('opening_hours', $contact->opening_hours) }}"
                           placeholder="Senin - Sabtu: 08.00 - 17.00 WIB">
                    @error('opening_hours')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label for="copyright" class="form-label">Copyright</label>
                    <input type="text" id="copyright" name="copyright"
                           class="form-control @error('copyright') is-invalid @enderror"
                           value="{{ old('copyright', $contact->copyright) }}">
                    @error('copyright')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-group--wide">
                    <label class="form-label">Logo Toko</label>
                    <div class="image-field">
                        <div class="image-field__preview">
                            @if (! empty($contact->logo))
                                <img src="{{ asset('storage/'.$contact->logo) }}" alt="Logo toko" class="image-field__img image-field__img--square">
                            @else
                                <span class="image-field__empty">Belum ada logo</span>
                            @endif
                        </div>
                        <div class="image-field__controls">
                            <input type="file" id="logo" name="logo"
                                   class="form-control @error('logo') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/webp,image/svg+xml">
                            <p class="form-hint">Format: jpg, jpeg, png, webp, svg. Maks 2MB.</p>
                            @error('logo')<span class="form-error">{{ $message }}</span>@enderror
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