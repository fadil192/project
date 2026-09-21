<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingUpdateRequest;
use App\Models\AppSetting;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'siteTitle' => AppSetting::get('site_title'),
            'metaDescription' => AppSetting::get('meta_description'),
            'metaKeywords' => AppSetting::get('meta_keywords'),
            'favicon' => AppSetting::get('favicon'),
        ]);
    }

    public function update(SettingUpdateRequest $request): RedirectResponse
    {
        AppSetting::set('site_title', $request->input('site_title'));
        AppSetting::set('meta_description', $request->input('meta_description'));
        AppSetting::set('meta_keywords', $request->input('meta_keywords'));

        if ($request->hasFile('favicon')) {
            $oldFavicon = AppSetting::get('favicon');
            $path = ImageUploadService::store($request->file('favicon'), 'favicon');
            AppSetting::set('favicon', $path);
            ImageUploadService::delete($oldFavicon);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}