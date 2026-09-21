<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CtaSectionUpdateRequest;
use App\Models\CtaSection;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CtaSectionController extends Controller
{
    public function index(): View
    {
        $ctas = CtaSection::query()->orderBy('section_key')->get();

        return view('admin.cta.index', compact('ctas'));
    }

    public function edit(CtaSection $cta): View
    {
        return view('admin.cta.edit', compact('cta'));
    }

    public function update(CtaSectionUpdateRequest $request, CtaSection $cta): RedirectResponse
    {
        $data = $request->safe()->except(['background_image']);

        if ($request->hasFile('background_image')) {
            $oldImage = $cta->background_image;
            $data['background_image'] = ImageUploadService::store($request->file('background_image'), 'cta');
            ImageUploadService::delete($oldImage);
        }

        $data['is_active'] = $request->boolean('is_active');
        $cta->update($data);

        return redirect()
            ->route('admin.cta.edit', $cta)
            ->with('success', 'CTA berhasil diperbarui.');
    }
}