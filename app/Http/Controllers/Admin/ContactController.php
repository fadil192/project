<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactUpdateRequest;
use App\Models\ContactSetting;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function edit(): View
    {
        $contact = ContactSetting::query()->orderBy('id')->first() ?? new ContactSetting();

        return view('admin.contact.edit', compact('contact'));
    }

    public function update(ContactUpdateRequest $request): RedirectResponse
    {
        $contact = ContactSetting::query()->orderBy('id')->first() ?? new ContactSetting();

        $data = $request->safe()->except(['logo']);

        if ($request->hasFile('logo')) {
            $oldLogo = $contact->logo;
            $data['logo'] = ImageUploadService::store($request->file('logo'), 'logos');
            ImageUploadService::delete($oldLogo);
        }

        $contact->fill($data)->save();

        return redirect()->route('admin.contact.edit')->with('success', 'Kontak & footer berhasil diperbarui.');
    }
}