<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Kategori;

class KategoriTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_bisa_melihat_daftar_kategori()
    {
        $response = $this->get('/kategori');
        $response->assertStatus(200);
    }

    public function test_user_bisa_mencari_kategori_atau_tutor()
    {
        // 1. Setup Data Kategori
        Kategori::create([
            'namakategori' => 'Pemrograman Web'
        ]);

        $this->withoutExceptionHandling();
        
        // 2. Action: Melakukan pencarian
        $response = $this->get('/search?query=Pemrograman');

        // 3. Assert: Pastikan sukses
        $response->assertStatus(200);
    }
}
