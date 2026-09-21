<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageSectionUpdateRequest;
use App\Models\PageSection;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class PageSectionController extends Controller
{
    public function index(): View
    {
        $sections = PageSection::query()->orderBy('section_key')->get();

        return view('admin.sections.index', compact('sections'));
    }

    public function edit(PageSection $section): View
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(PageSectionUpdateRequest $request, PageSection $section): RedirectResponse
    {
        $data = $request->safe()->except(['image']);

        if ($request->hasFile('image')) {
            $oldImage = $section->image;
            $data['image'] = ImageUploadService::store($request->file('image'), 'sections');
            ImageUploadService::delete($oldImage);
        }

        $data['is_active'] = $request->boolean('is_active');
        $section->update($data);

        return redirect()
            ->route('admin.sections.edit', $section)
            ->with('success', 'Konten section "'.$section->title.'" berhasil diperbarui.');
    }
}