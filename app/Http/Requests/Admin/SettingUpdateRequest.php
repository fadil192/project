<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'favicon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg,ico', 'max:1024'],
        ];
    }

    public function messages(): array
    {
        return [
            'site_title.required' => 'Judul website wajib diisi.',
        ];
    }
}