<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TutorTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_bisa_melihat_daftar_rekomendasi_tutor()
    {
        $response = $this->get('/tutor');

        $response->assertStatus(200);
    }

public function test_user_bisa_melihat_detail_profil_tutor()
{
    // 1. SETUP: Insert manual data dummy
    $tutor = \App\Models\Tutor::create([
        'nama' => 'Juno',
        'kategori_id' => 1, // Sesuaikan dengan struktur tabelmu
        'harga' => 50000,
        // ... isi kolom wajib (NOT NULL) lainnya yang ada di tabel tutors
    ]);

    // 2. ACTION & ASSERT
    $response = $this->get('/tutor/' . $tutor->id);
    $response->assertStatus(200);
}
}
