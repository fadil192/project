<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * Simpan file gambar ke disk public dan kembalikan path-nya.
     */
    public static function store(\Illuminate\Http\UploadedFile $file, string $directory = 'images'): string
    {
        return $file->store($directory, 'public');
    }

    /**
     * Hapus file dari disk public jika memang ada.
     */
    public static function delete(?string $path): void
    {
        if ($path !== null && $path !== '' && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}