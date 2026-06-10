<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class LaporanMasalahTest extends TestCase
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

    private function buatPesanan(int $userId): array
    {
        $kategoriId = DB::table('kategori')->insertGetId([
            'namakategori' => 'Informatika',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $tutorId = DB::table('tutor')->insertGetId([
            'nama'       => 'Tutor Test',
            'pekerjaan'  => 'Mahasiswa',
            'deskripsi'  => 'Tutor test',
            'fototutor'  => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $matkulId = DB::table('matakuliah')->insertGetId([
            'namamatkul' => 'Algoritma',
            'idkategori' => $kategoriId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sesiId = DB::table('sesi')->insertGetId([
            'namaSesi'   => 'Sesi Algoritma',
            'idtutor'    => $tutorId,
            'idmatkul'   => $matkulId,
            'harga'      => 50000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $pesananId = DB::table('pesanan')->insertGetId([
            'userid'     => $userId,
            'idsesi'     => $sesiId,
            'tanggal'    => '2026-01-01',
            'jam'        => '10.00-11.00',
            'durasi'     => 1,
            'biaya'      => 50000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return ['pesananId' => $pesananId, 'sesiId' => $sesiId];
    }

    // ─── create ────────────────────────────────────────────────────────────────

    public function test_form_laporan_tampil_untuk_pesanan_valid()
    {
        $userId = $this->buatUser();
        $data   = $this->buatPesanan($userId);

        $response = $this->withSession(['user_id' => $userId])
            ->get("/aktivitas/laporan/{$data['pesananId']}");

        $response->assertStatus(200);
        $response->assertViewIs('Laporan-Masalah');
    }

    public function test_form_laporan_redirect_login_jika_belum_login()
    {
        $response = $this->get('/aktivitas/laporan/1');

        $response->assertRedirect('/login');
    }

    public function test_form_laporan_404_jika_pesanan_bukan_miliknya()
    {
        $userId = $this->buatUser();

        $response = $this->withSession(['user_id' => $userId])
            ->get('/aktivitas/laporan/99999');

        $response->assertStatus(404);
    }

    public function test_form_laporan_redirect_jika_sudah_pernah_lapor()
    {
        $userId = $this->buatUser();
        $data   = $this->buatPesanan($userId);

        // Sudah ada laporan untuk pesanan ini
        DB::table('laporanmasalah')->insert([
            'userid'           => $userId,
            'idpesanan'        => $data['pesananId'],
            'kategorimasalah'  => 'Tutor tidak hadir',
            'deskripsimasalah' => 'Deskripsi',
            'statuslaporan'    => 'Diproses',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        $response = $this->withSession(['user_id' => $userId])
            ->get("/aktivitas/laporan/{$data['pesananId']}");

        $response->assertRedirect(route('history.laporan'));
        $response->assertSessionHas('error');
    }

    // ─── store ─────────────────────────────────────────────────────────────────

    public function test_store_laporan_biasa_berhasil()
    {
        $userId = $this->buatUser();
        $data   = $this->buatPesanan($userId);

        $response = $this->withSession(['user_id' => $userId])
            ->post('/aktivitas/laporan/store', [
                'idpesanan'     => $data['pesananId'],
                'jenis_masalah' => 'Koneksi Bermasalah',
                'deskripsi'     => 'Internet putus saat sesi',
            ]);

        $response->assertRedirect(route('laporan.selesai'));

        $this->assertDatabaseHas('laporanmasalah', [
            'userid'          => $userId,
            'idpesanan'       => $data['pesananId'],
            'kategorimasalah' => 'Koneksi Bermasalah',
            'statuslaporan'   => 'Laporan_Diterima',
        ]);

        // Laporan biasa tidak membuat refund
        $this->assertDatabaseMissing('refund', [
            'statusrefund' => 'Diproses',
        ]);
    }

    public function test_store_laporan_refund_otomatis_dibuat()
    {
        $userId = $this->buatUser();
        $data   = $this->buatPesanan($userId);

        $response = $this->withSession(['user_id' => $userId])
            ->post('/aktivitas/laporan/store', [
                'idpesanan'     => $data['pesananId'],
                'jenis_masalah' => 'Tutor Tidak Hadir',
                'deskripsi'     => 'Tutor tidak datang sama sekali',
            ]);

        $response->assertRedirect(route('laporan.selesai'));

        $this->assertDatabaseHas('laporanmasalah', [
            'idpesanan'     => $data['pesananId'],
            'statuslaporan' => 'Refund_Diajukan',
        ]);

        // Refund otomatis terbuat
        $this->assertDatabaseHas('refund', [
            'statusrefund'       => 'Diproses',
            'jumlahpengembalian' => 50000,
        ]);
    }

    public function test_store_laporan_403_jika_pesanan_bukan_miliknya()
    {
        $userId = $this->buatUser();

        $response = $this->withSession(['user_id' => $userId])
            ->post('/aktivitas/laporan/store', [
                'idpesanan'     => 99999,
                'jenis_masalah' => 'Tutor Tidak Hadir',
                'deskripsi'     => 'Test',
            ]);

        $response->assertStatus(403);
    }

    // ─── detailMasalah ─────────────────────────────────────────────────────────

    public function test_detail_masalah_tampil_dengan_jenis_valid()
    {
        $userId = $this->buatUser();
        $data   = $this->buatPesanan($userId);

        $response = $this->withSession(['user_id' => $userId])
            ->get("/aktivitas/laporan/{$data['pesananId']}/masalah?jenis=Tutor+Tidak+Hadir");

        $response->assertStatus(200);
        $response->assertViewIs('Laporan-Detail-Masalah');
        $response->assertViewHas('jenisMasalah', 'Tutor Tidak Hadir');
    }

    public function test_detail_masalah_404_tanpa_parameter_jenis()
    {
        $userId = $this->buatUser();
        $data   = $this->buatPesanan($userId);

        $response = $this->withSession(['user_id' => $userId])
            ->get("/aktivitas/laporan/{$data['pesananId']}/masalah");

        $response->assertStatus(404);
    }

    // ─── laporanSukses ─────────────────────────────────────────────────────────

    public function test_laporan_sukses_tampil()
    {
        $response = $this->withSession(['type' => 'laporan'])
            ->get('/aktivitas/laporan/berhasil');

        $response->assertStatus(200);
        $response->assertViewIs('Laporan-Berhasil');
    }
}