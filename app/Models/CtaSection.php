<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtaSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_key',
        'title',
        'description',
        'button_text',
        'whatsapp_number',
        'whatsapp_message',
        'background_image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}