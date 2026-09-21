<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PromoProductRequest;
use App\Models\PromoProduct;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PromoProductController extends Controller
{
    public function index(): View
    {
        $products = PromoProduct::query()->ordered()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(PromoProductRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image']);
        $data['slug'] = $this->makeUniqueSlug($data['name'], $request->input('slug'));

        if ($request->hasFile('image')) {
            $data['image'] = ImageUploadService::store($request->file('image'), 'products');
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        PromoProduct::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk promo berhasil ditambahkan.');
    }

    public function edit(PromoProduct $product): View
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(PromoProductRequest $request, PromoProduct $product): RedirectResponse
    {
        $data = $request->safe()->except(['image']);
        $data['slug'] = $this->makeUniqueSlug($data['name'], $request->input('slug'), $product->id);

        if ($request->hasFile('image')) {
            $oldImage = $product->image;
            $data['image'] = ImageUploadService::store($request->file('image'), 'products');
            ImageUploadService::delete($oldImage);
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? $product->sort_order;

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk promo berhasil diperbarui.');
    }

    public function destroy(PromoProduct $product): RedirectResponse
    {
        $oldImage = $product->image;
        $product->delete();
        ImageUploadService::delete($oldImage);

        return redirect()->route('admin.products.index')->with('success', 'Produk promo berhasil dihapus.');
    }

    public function toggle(PromoProduct $product): RedirectResponse
    {
        $product->update(['is_active' => ! $product->is_active]);

        return back()->with('success', 'Status produk berhasil diubah.');
    }

    private function makeUniqueSlug(string $name, ?string $inputSlug, ?int $ignoreId = null): string
    {
        $slug = Str::slug($inputSlug && $inputSlug !== '' ? $inputSlug : $name);
        $base = $slug;
        $counter = 2;

        while (PromoProduct::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}