<?php

use App\Services\WhatsAppService;

if (! function_exists('wa_normalize')) {
    function wa_normalize(?string $number): string
    {
        return WhatsAppService::normalizeNumber((string) $number);
    }
}

if (! function_exists('wa_link')) {
    function wa_link(?string $number, ?string $message = null): string
    {
        return WhatsAppService::link((string) $number, $message);
    }
}

if (! function_exists('rupiah')) {
    function rupiah(?string $amount): string
    {
        if ($amount === null || $amount === '') {
            return '';
        }

        return 'Rp '.number_format((float) $amount, 0, ',', '.');
    }
}