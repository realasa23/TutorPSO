<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class PesananTest extends TestCase
{
    use RefreshDatabase;

    // ─── Helper: buat user dan return userid ───────────────────────────────────
    private function buatUser(): int
    {
        return DB::table('user')->insertGetId([
            'username'   => 'testuser',
            'email'      => 'test@test.com',
            'password'   => bcrypt('password'),
            'nomorhp'    => '081234567890',
            'kuotatrial' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // ─── Helper: buat sesi lengkap dengan tutor & matkul ───────────────────────
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

    // ─── storeRegular ──────────────────────────────────────────────────────────

    public function test_store_regular_berhasil()
    {
        $userId = $this->buatUser();
        $sesiId = $this->buatSesi();

        $response = $this->withSession(['user_id' => $userId])
            ->post('/konfirmasi-pesanan', [
                'idsesi'  => $sesiId,
                'tanggal' => '2026-12-01',
                'jam'     => '10.00-11.00',
                'durasi'  => 1,
            ]);

        $response->assertStatus(200);
        $response->assertViewIs('Konfirmasi-Pesanan');

        $this->assertDatabaseHas('pesanan', [
            'userid'  => $userId,
            'idsesi'  => $sesiId,
            'tanggal' => '2026-12-01',
            'biaya'   => 50000,
        ]);
    }

    public function test_store_regular_gagal_jika_sudah_pesan_sama()
    {
        $userId = $this->buatUser();
        $sesiId = $this->buatSesi();

        // Pesanan pertama
        DB::table('pesanan')->insert([
            'userid'     => $userId,
            'idsesi'     => $sesiId,
            'tanggal'    => '2026-12-01',
            'jam'        => '10.00-11.00',
            'durasi'     => 1,
            'biaya'      => 50000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Coba pesan lagi dengan tanggal & jam sama
        $response = $this->withSession(['user_id' => $userId])
            ->post('/konfirmasi-pesanan', [
                'idsesi'  => $sesiId,
                'tanggal' => '2026-12-01',
                'jam'     => '10.00-11.00',
                'durasi'  => 1,
            ]);

        $response->assertSessionHas('error');

        // Pastikan tidak ada insert dobel
        $this->assertEquals(1, DB::table('pesanan')
            ->where('userid', $userId)
            ->where('idsesi', $sesiId)
            ->count()
        );
    }

    public function test_store_regular_redirect_login_jika_belum_login()
    {
        $sesiId = $this->buatSesi();

        $response = $this->post('/konfirmasi-pesanan', [
            'idsesi'  => $sesiId,
            'tanggal' => '2026-12-01',
            'jam'     => '10.00-11.00',
            'durasi'  => 1,
        ]);

        $response->assertRedirect('/login');
    }

    // ─── storeTrial ────────────────────────────────────────────────────────────

    public function test_store_trial_berhasil_dan_biaya_nol()
    {
        $userId = $this->buatUser();
        $sesiId = $this->buatSesi();

        $response = $this->withSession(['user_id' => $userId])
            ->post('/konfirmasi-trial', [
                'idsesi'  => $sesiId,
                'tanggal' => '2026-12-01',
                'jam'     => '10.00-11.00',
                'durasi'  => 1,
            ]);

        $response->assertStatus(200);
        $response->assertViewIs('Konfirmasi-Trial');

        $this->assertDatabaseHas('pesanan', [
            'userid' => $userId,
            'idsesi' => $sesiId,
            'biaya'  => 0,
        ]);
    }

    public function test_store_trial_gagal_jika_sudah_pernah_trial_sesi_sama()
    {
        $userId = $this->buatUser();
        $sesiId = $this->buatSesi();

        // Trial pertama
        DB::table('pesanan')->insert([
            'userid'     => $userId,
            'idsesi'     => $sesiId,
            'tanggal'    => '2026-12-01',
            'jam'        => '10.00-11.00',
            'durasi'     => 1,
            'biaya'      => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Coba trial lagi di sesi yang sama
        $response = $this->withSession(['user_id' => $userId])
            ->post('/konfirmasi-trial', [
                'idsesi'  => $sesiId,
                'tanggal' => '2026-12-02',
                'jam'     => '11.00-12.00',
                'durasi'  => 1,
            ]);

        $response->assertSessionHas('error');

        $this->assertEquals(1, DB::table('pesanan')
            ->where('userid', $userId)
            ->where('idsesi', $sesiId)
            ->where('biaya', 0)
            ->count()
        );
    }

    // ─── aktivitas ─────────────────────────────────────────────────────────────

    public function test_aktivitas_tampil_dengan_tab_default()
    {
        $userId = $this->buatUser();

        $response = $this->withSession(['user_id' => $userId])
            ->get('/aktivitas');

        $response->assertStatus(200);
        $response->assertViewIs('Aktivitas');
        $response->assertViewHas('tab', 'akan-datang');
    }

    public function test_aktivitas_redirect_login_jika_belum_login()
    {
        $response = $this->get('/aktivitas');

        $response->assertRedirect('/login');
    }
}