<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'normal_price',
        'promo_price',
        'image',
        'whatsapp_number',
        'whatsapp_message',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'normal_price' => 'decimal:2',
            'promo_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function getWaNumber(): string
    {
        return $this->whatsapp_number ?? '';
    }

    public function getWaMessage(): string
    {
        return $this->whatsapp_message ?:
            'Halo, saya tertarik dengan produk '.$this->name.'. Apakah produk tersebut masih tersedia?';
    }
}