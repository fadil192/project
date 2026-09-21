<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HeroUpdateRequest;
use App\Models\Hero;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HeroController extends Controller
{
    public function edit(): View
    {
        $hero = Hero::query()->orderBy('id')->first() ?? new Hero();

        return view('admin.hero.edit', compact('hero'));
    }

    public function update(HeroUpdateRequest $request): RedirectResponse
    {
        $hero = Hero::query()->orderBy('id')->first() ?? new Hero();

        $data = $request->safe()->except(['image']);

        if ($request->hasFile('image')) {
            $oldImage = $hero->image;
            $data['image'] = ImageUploadService::store($request->file('image'), 'hero');
            ImageUploadService::delete($oldImage);
        }

        $data['is_active'] = $request->boolean('is_active');
        $hero->fill($data)->save();

        return redirect()->route('admin.hero.edit')->with('success', 'Hero banner berhasil diperbarui.');
    }
}