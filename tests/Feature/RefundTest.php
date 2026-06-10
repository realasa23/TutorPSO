<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class RefundTest extends TestCase
{
    use RefreshDatabase;

    // ─── Helpers ───────────────────────────────────────────────────────────────

    private function buatUser(): int
    {
        return DB::table('user')->insertGetId([
            'username'   => 'testuser',
            'email'      => 'test@test.com',
            'password'   => bcrypt('password'),
            'nomorhp'    => '081234567890',
            'kuotatrial' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function buatSesi(): int
    {
        // Step 1: buat kategori dulu
        $kategoriId = DB::table('kategori')->insertGetId([
            'namakategori' => 'Informatika',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // Step 2: buat tutor
        $tutorId = DB::table('tutor')->insertGetId([
            'nama'       => 'Tutor Test',
            'pekerjaan'  => 'Mahasiswa',
            'deskripsi'  => 'Tutor test',
            'fototutor'  => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Step 3: buat matakuliah dengan idkategori
        $matkulId = DB::table('matakuliah')->insertGetId([
            'namamatkul'  => 'Algoritma',
            'idkategori'  => $kategoriId,   // ← tambah ini
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Step 4: buat sesi
        return DB::table('sesi')->insertGetId([
            'namaSesi'   => 'Sesi Algoritma',
            'idtutor'    => $tutorId,
            'idmatkul'   => $matkulId,
            'harga'      => 50000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function buatPesanan(int $userId, int $sesiId): int
    {
        return DB::table('pesanan')->insertGetId([
            'userid'     => $userId,
            'idsesi'     => $sesiId,
            'tanggal'    => '2026-12-01',
            'jam'        => '10:00-11:00',
            'durasi'     => 1,
            'biaya'      => 50000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function buatLaporan(int $userId, int $idpesanan): int
    {
        return DB::table('laporanmasalah')->insertGetId([
            'userid'           => $userId,
            'idpesanan'        => $idpesanan,
            'kategorimasalah'  => 'Tutor tidak hadir',
            'deskripsimasalah' => 'Deskripsi test',   // ← tambah ini
            'statuslaporan'    => 'Diproses',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
    }

   private function buatRefund(int $idlaporan, string $status = 'Pending'): int
    {
        return DB::table('refund')->insertGetId([
            // ← hapus 'idrefund', biarkan auto-increment
            'idlaporan'          => $idlaporan,
            'statusrefund'       => $status,
            'jumlahpengembalian' => 50000,
        ]);
    }

    // ─── processRefund ─────────────────────────────────────────────────────────

    public function test_history_laporan_tampil_untuk_user_login()
    {
        $userId  = $this->buatUser();
        $sesiId  = $this->buatSesi();
        $this->buatPesanan($userId, $sesiId);
        $pesananId = $this->buatPesanan($userId, $sesiId);
        $lapId= $this->buatLaporan($userId, $pesananId);
        $this->buatRefund($lapId);

        $response = $this->withSession(['user_id' => $userId])
            ->get('/profile/laporan');

        $response->assertStatus(200);
        $response->assertViewIs('History-Laporan');
        $response->assertViewHas('laporan');
    }

    public function test_history_laporan_hanya_milik_user_sendiri()
    {
        $userId1 = $this->buatUser();

        // User kedua
        $userId2 = DB::table('user')->insertGetId([
            'username'   => 'user2',
            'email'      => 'user2@test.com',
            'password'   => bcrypt('password'),
            'nomorhp'    => '089999999999',
            'kuotatrial' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sesiId = $this->buatSesi();

        // Laporan milik user2
        $this->buatPesanan($userId2, $sesiId);
        $this->buatLaporan($userId2, $sesiId);

        // Login sebagai user1, tidak boleh lihat laporan user2
        $response = $this->withSession(['user_id' => $userId1])
            ->get('/profile/laporan');

        $response->assertStatus(200);
        $laporan = $response->viewData('laporan');
        $this->assertCount(0, $laporan);
    }

    public function test_history_laporan_redirect_login_jika_belum_login()
    {
        $response = $this->get('/profile/laporan');

        $response->assertRedirect('/login');
    }

    // ─── refundSelesai ─────────────────────────────────────────────────────────

    public function test_refund_selesai_update_status_jadi_berhasil()
    {
        $userId  = $this->buatUser();
        $sesiId  = $this->buatSesi();
        $this->buatPesanan($userId, $sesiId);
        $lapId   = $this->buatLaporan($userId, $sesiId);
        $this->buatRefund($lapId, 'Pending');

        $response = $this->withSession(['user_id' => $userId])
            ->get("/profile/laporan/{$lapId}");

        $response->assertStatus(200);
        $response->assertViewIs('Refund-Berhasil');
        $response->assertViewHas('harga', 50000);

        // Pastikan status di DB sudah terupdate
        $this->assertDatabaseHas('refund', [
            'idlaporan'    => $lapId,
            'statusrefund' => 'Berhasil',
        ]);
    }

    public function test_refund_selesai_tidak_update_jika_sudah_berhasil()
    {
        $userId  = $this->buatUser();
        $sesiId  = $this->buatSesi();
        $this->buatPesanan($userId, $sesiId);
        $lapId   = $this->buatLaporan($userId, $sesiId);
        $this->buatRefund($lapId, 'Berhasil'); // sudah berhasil

        $response = $this->withSession(['user_id' => $userId])
            ->get("/profile/laporan/{$lapId}");

        $response->assertStatus(200);
        $response->assertViewIs('Refund-Berhasil');

        // Status tidak berubah, tetap 'Berhasil'
        $this->assertDatabaseHas('refund', [
            'idlaporan'    => $lapId,
            'statusrefund' => 'Berhasil',
        ]);
    }

    public function test_refund_selesai_404_jika_laporan_tidak_ditemukan()
    {
        $userId = $this->buatUser();

        $response = $this->withSession(['user_id' => $userId])
            ->get('/profile/laporan/99999');

        $response->assertStatus(404);
    }

    public function test_refund_selesai_redirect_login_jika_belum_login()
    {
        $response = $this->get('/profile/laporan/1');

        $response->assertRedirect('/login');
    }
}