<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pesanan;

class LaporanMasalahTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_bisa_mengirim_laporan_masalah()
    {
        // 1. Setup User Login
        $user = User::factory()->create();
        $this->actingAs($user);

        // 2. Setup Data Pesanan Dummy (Kita isi semua yang berpotensi NOT NULL)
        $pesanan = new Pesanan();

        $pesanan->userid = $user->iduser ?? $user->id ?? 1;
        $pesanan->idsesi = 1;
        $pesanan->tanggal = '2026-05-20';

        // TAMBAHKAN BARIS INI KEMBALI
        $pesanan->jam = '08:00:00';

        $pesanan->save();

        // 3. Action: Kirim laporan masalah ke rute yang benar
        $response = $this->post('/aktivitas/laporan/store', [
            'pesanan_id' => $pesanan->idpesanan ?? $pesanan->id,
            'jenis_masalah' => 'Materi Tidak Sesuai',
            'detail_alasan' => 'Tutor mengajarkan materi yang tidak sesuai dengan silabus.'
        ]);

        // 4. Assert: Pastikan berhasil redirect (302)
        $response->assertStatus(302);
    }
}
