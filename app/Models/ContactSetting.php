<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'logo',
        'address',
        'phone',
        'whatsapp',
        'email',
        'opening_hours',
        'description',
        'copyright',
    ];

    public function scopeDefault($query)
    {
        return $query->orderBy('id')->limit(1);
    }
}