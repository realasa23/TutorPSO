<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SesiTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_sesi_berdasarkan_matkul_404_jika_matkul_tidak_ada()
    {
        // Cari matkul yang ID-nya tidak mungkin ada
        $response = $this->get('/sesi/matkul/M999');
        $response->assertStatus(404);
    }

    public function test_list_sesi_berdasarkan_tutor_404_jika_tutor_tidak_ada()
    {
        // Cari tutor yang ID-nya tidak mungkin ada
        $response = $this->get('/sesi/tutor/T999');
        $response->assertStatus(404);
    }

    public function test_pesan_sesi_404_jika_sesi_tidak_ada()
    {
        // Buka halaman pesan sesi dengan ID ngawur
        $response = $this->get('/pesan/sesi/999');
        $response->assertStatus(404);
    }
}
