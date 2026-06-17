<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_user_bisa_melihat_halaman_register()
    {
        // Pastikan URL '/register' sesuai dengan rute di web.php kamu.
        // Jika di kodemu memakai bahasa indonesia (misal: '/daftar'), silakan diganti.
        $response = $this->get('/register');

        // Memastikan halaman berhasil dimuat dengan sempurna (HTTP 200 OK)
        $response->assertStatus(200);
    }
}
