<?php

namespace Tests\Unit;

use App\Services\WhatsAppService;
use PHPUnit\Framework\TestCase;

class WhatsAppTest extends TestCase
{
    public function test_number_with_leading_zero_is_normalized(): void
    {
        $this->assertSame('6281234567890', WhatsAppService::normalizeNumber('081234567890'));
    }

    public function test_number_with_plus_is_normalized(): void
    {
        $this->assertSame('6281234567890', WhatsAppService::normalizeNumber('+6281234567890'));
    }

    public function test_number_with_spaces_and_dashes_is_normalized(): void
    {
        $this->assertSame('6281234567890', WhatsAppService::normalizeNumber('0812-3456-7890'));
        $this->assertSame('6281234567890', WhatsAppService::normalizeNumber('+62 812 3456 7890'));
    }

    public function test_number_starting_with_8_is_normalized(): void
    {
        $this->assertSame('6281234567890', WhatsAppService::normalizeNumber('81234567890'));
    }

    public function test_wa_link_is_built_correctly(): void
    {
        $this->assertSame(
            'https://wa.me/6281234567890',
            WhatsAppService::link('081234567890')
        );
    }

    public function test_wa_link_with_message_is_urlencoded(): void
    {
        $url = WhatsAppService::link(
            '081234567890',
            'Halo, saya tertarik dengan produk Kampas Rem. Apakah produk tersebut masih tersedia?'
        );

        $this->assertStringStartsWith('https://wa.me/6281234567890?text=', $url);
        $this->assertSame('Halo%2C+saya+tertarik+dengan+produk+Kampas+Rem.+Apakah+produk+tersebut+masih+tersedia%3F', substr($url, strlen('https://wa.me/6281234567890?text=')));
    }

    public function test_empty_number_returns_hash(): void
    {
        $this->assertSame('#', WhatsAppService::link(''));
    }
}