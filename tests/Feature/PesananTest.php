<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Models\user;
use Illuminate\Support\Facades\DB;

class PesananTest extends TestCase
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

        $idsesi = DB::table('sesi')->insertGetId([
            'idmatkul' => '1',
            'idtutor' => '1',
            'harga' => 50000,
            'namaSesi' => 'Belajar Aljabar',
        ]);

        return [$user, $idsesi];
    }

    public function test_store_regular_berhasil_dan_gagal_jika_dobel()
    {
        [$user, $idsesi] = $this->createDummyData();
        $tanggal = now()->addDays(1)->toDateString();

        $response = $this->post('/konfirmasi-pesanan', [
            'idsesi' => $idsesi,
            'tanggal' => $tanggal,
            'jam' => '10:00',
            'durasi' => 2,
        ]);
        $response->assertStatus(200);

        $responseFail = $this->post('/konfirmasi-pesanan', [
            'idsesi' => $idsesi,
            'tanggal' => $tanggal,
            'jam' => '10:00',
            'durasi' => 2,
        ]);
        $responseFail->assertRedirect()->assertSessionHas('error');
    }

    public function test_store_trial_berhasil_dan_gagal_jika_dobel()
    {
        [$user, $idsesi] = $this->createDummyData();
        $tanggal = now()->addDays(2)->toDateString();

        $response = $this->post('/konfirmasi-trial', [
            'idsesi' => $idsesi,
            'tanggal' => $tanggal,
            'jam' => '14:00',
            'durasi' => 1,
        ]);
        $response->assertStatus(200);

        $responseFail = $this->post('/konfirmasi-trial', [
            'idsesi' => $idsesi,
            'tanggal' => now()->addDays(3)->toDateString(),
            'jam' => '15:00',
            'durasi' => 1,
        ]);
        $responseFail->assertRedirect()->assertSessionHas('error');
    }

    public function test_gabung_sesi_dan_detail_aktivitas()
    {
        [$user, $idsesi] = $this->createDummyData();
        $idpesanan = DB::table('pesanan')->insertGetId([
            'userid' => $user->userid, 'idsesi' => $idsesi, 'tanggal' => now()->toDateString(),
            'jam' => '10:00', 'durasi' => 1, 'biaya' => 50000
        ]);

        $this->get('/gabung-sesi/' . $idpesanan)->assertStatus(200);
        $this->get('/gabung-sesi/999')->assertStatus(404);

        $this->get('/aktivitas/detail/' . $idpesanan)->assertStatus(200);
        $this->get('/aktivitas/detail/999')->assertStatus(404);
    }

    public function test_end_call()
    {
        $this->get('/gabung-sesi/1/end-call')->assertRedirect();
    }

    public function test_aktivitas_dan_status_realtime()
    {
        [$user, $idsesi] = $this->createDummyData();

        $pesanans = [
            ['userid' => $user->userid, 'idsesi' => $idsesi, 'tanggal' => now()->subDays(1)->toDateString(), 'jam' => '10:00', 'durasi' => 1, 'biaya' => 0],
            ['userid' => $user->userid, 'idsesi' => $idsesi, 'tanggal' => now()->addDays(1)->toDateString(), 'jam' => '10:00', 'durasi' => 1, 'biaya' => 0],
            ['userid' => $user->userid, 'idsesi' => $idsesi, 'tanggal' => now()->toDateString(), 'jam' => now()->subMinutes(10)->format('H:i'), 'durasi' => 1, 'biaya' => 0],
            ['userid' => $user->userid, 'idsesi' => $idsesi, 'tanggal' => now()->addYears(100)->toDateString(), 'jam' => '99:99', 'durasi' => 1, 'biaya' => 0],
        ];

        foreach ($pesanans as $pesanan) {
            DB::table('pesanan')->insert($pesanan);
        }

        $this->get('/aktivitas?tab=lampau')->assertStatus(200);
        $this->get('/aktivitas?tab=akan-datang')->assertStatus(200);
        $this->get('/aktivitas?tab=berlangsung')->assertStatus(200);
    }

    public function test_semua_rute_redirect_jika_belum_login()
    {
        session()->flush();
        $this->post('/konfirmasi-pesanan')->assertRedirect('/login');
        $this->post('/konfirmasi-trial')->assertRedirect('/login');
        $this->get('/gabung-sesi/1')->assertRedirect('/login');
        $this->get('/aktivitas')->assertRedirect('/login');
        $this->get('/aktivitas/detail/1')->assertRedirect('/login');
    }
}
