<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Models\user;
use Illuminate\Support\Facades\DB;

class LaporanMasalahTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Schema::disableForeignKeyConstraints();
    }

    private function createDummyData()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        session(['user_id' => $user->userid]);

        DB::table('kategori')->insert(['idkategori' => 1, 'namakategori' => 'Eksakta']);
        DB::table('matakuliah')->insert(['idmatkul' => '1', 'idkategori' => 1, 'namamatkul' => 'Matematika']);
        DB::table('tutor')->insert(['idtutor' => '1', 'nama' => 'Pak Budi', 'fototutor' => '']);

        DB::table('sesi')->insert([
            'idsesi' => 1, 'idtutor' => '1', 'idmatkul' => '1', 'namaSesi' => 'Belajar Aljabar', 'harga' => 50000
        ]);

        $idpesanan = DB::table('pesanan')->insertGetId([
            'userid' => $user->userid, 'idsesi' => 1, 'tanggal' => now()->toDateString(),
            'jam' => '10:00', 'durasi' => 1, 'biaya' => 50000
        ]);

        return [$user, $idpesanan];
    }

    public function test_create_laporan_dan_redirect_jika_sudah_lapor()
    {
        [$user, $idpesanan] = $this->createDummyData();

        $this->get('/aktivitas/laporan/' . $idpesanan)->assertStatus(200);
        $this->get('/aktivitas/laporan/999')->assertStatus(404);

        // FIX: Tambahkan 'deskripsimasalah' di sini biar SQLite nggak ngambek
        DB::table('laporanmasalah')->insert([
            'idlaporan' => 1,
            'userid' => $user->userid,
            'idpesanan' => $idpesanan,
            'kategorimasalah' => 'Lainnya',
            'deskripsimasalah' => 'Ini contoh deskripsi masalah',
            'statuslaporan' => 'Laporan_Diterima'
        ]);

        $this->get('/aktivitas/laporan/' . $idpesanan)->assertRedirect()->assertSessionHas('error');
    }

    public function test_detail_masalah()
    {
        [$user, $idpesanan] = $this->createDummyData();

        $this->get('/aktivitas/laporan/' . $idpesanan . '/masalah?jenis=Tutor+Tidak+Hadir')->assertStatus(200);
        $this->get('/aktivitas/laporan/999/masalah?jenis=Tutor+Tidak+Hadir')->assertStatus(404);
        $this->get('/aktivitas/laporan/' . $idpesanan . '/masalah')->assertStatus(404);
    }

    public function test_store_laporan_masalah_biasa_dan_refund()
    {
        [$user, $idpesanan] = $this->createDummyData();

        $responseRefund = $this->post('/aktivitas/laporan/store', [
            'idpesanan' => $idpesanan,
            'jenis_masalah' => 'Tutor Tidak Hadir',
            'deskripsi' => 'Tutornya ngilang'
        ]);
        $responseRefund->assertRedirect();
        $this->assertDatabaseHas('refund', ['statusrefund' => 'Diproses']);

        $idpesananBiasa = DB::table('pesanan')->insertGetId([
            'userid' => $user->userid, 'idsesi' => 1, 'tanggal' => now()->toDateString(), 'jam' => '12:00'
        ]);

        $responseBiasa = $this->post('/aktivitas/laporan/store', [
            'idpesanan' => $idpesananBiasa,
            'jenis_masalah' => 'Lainnya',
            'deskripsi' => 'Materi kurang jelas'
        ]);
        $responseBiasa->assertRedirect();
        $this->assertDatabaseHas('laporanmasalah', ['idpesanan' => $idpesananBiasa, 'statuslaporan' => 'Laporan_Diterima']);

        $this->post('/aktivitas/laporan/store', [
            'idpesanan' => 999, 'jenis_masalah' => 'Lainnya', 'deskripsi' => 'Test'
        ])->assertStatus(403);
    }

    public function test_halaman_laporan_sukses()
    {
        session(['type' => 'refund']);
        $this->get('/aktivitas/laporan/berhasil')->assertStatus(200);
    }
}
