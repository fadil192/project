<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SocialLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $socialId = $this->route('social')?->id;

        return [
            'platform' => ['required', 'string', 'max:50', Rule::unique('social_links', 'platform')->ignore($socialId)],
            'url' => ['required', 'url', 'max:500'],
            'icon' => ['nullable', 'string', 'max:50'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'platform.required' => 'Platform wajib diisi.',
            'url.required' => 'URL wajib diisi.',
            'url.url' => 'Format URL tidak valid.',
        ];
    }
}