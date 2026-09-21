<?php

namespace App\Services;

class WhatsAppService
{
    /**
     * Bersihkan nomor ke format internasional tanpa karakter non-digit.
     * Contoh: 081234567890 -> 6281234567890
     */
    public static function normalizeNumber(string $number): string
    {
        $digits = preg_replace('/\D+/', '', $number) ?? '';

        if (str_starts_with($digits, '0')) {
            $digits = '62'.substr($digits, 1);
        } elseif (str_starts_with($digits, '8')) {
            $digits = '62'.$digits;
        }

        return $digits;
    }

    /**
     * Bangun URL WhatsApp wa.me dengan pesan ter-encode.
     */
    public static function link(string $number, ?string $message = null): string
    {
        $clean = self::normalizeNumber($number);

        if (empty($clean)) {
            return '#';
        }

        $url = 'https://wa.me/'.$clean;

        if ($message !== null && $message !== '') {
            $url .= '?text='.urlencode($message);
        }

        return $url;
    }
}