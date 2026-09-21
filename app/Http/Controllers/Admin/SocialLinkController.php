<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SocialLinkController extends Controller
{
    protected const PLATFORMS = ['instagram', 'facebook', 'tiktok', 'youtube', 'x'];

    public function index(): View
    {
        $socials = SocialLink::query()->ordered()->get();
        $platforms = self::PLATFORMS;

        return view('admin.social.index', compact('socials', 'platforms'));
    }

    public function store(SocialLinkRequest $request): RedirectResponse
    {
        SocialLink::create([
            'platform' => $request->platform,
            'url' => $request->url,
            'icon' => $request->icon ?: $request->platform,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        return redirect()->route('admin.social.index')->with('success', 'Link sosial media berhasil ditambahkan.');
    }

    public function edit(SocialLink $social): View
    {
        $platforms = self::PLATFORMS;

        return view('admin.social.edit', compact('social', 'platforms'));
    }

    public function update(SocialLinkRequest $request, SocialLink $social): RedirectResponse
    {
        $social->update([
            'platform' => $request->platform,
            'url' => $request->url,
            'icon' => $request->icon ?: $request->platform,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->input('sort_order', $social->sort_order),
        ]);

        return redirect()->route('admin.social.index')->with('success', 'Link sosial media berhasil diperbarui.');
    }

    public function destroy(SocialLink $social): RedirectResponse
    {
        $social->delete();

        return redirect()->route('admin.social.index')->with('success', 'Link sosial media berhasil dihapus.');
    }

    public function toggle(SocialLink $social): RedirectResponse
    {
        $social->update(['is_active' => ! $social->is_active]);

        return back()->with('success', 'Status sosial media berhasil diubah.');
    }
}