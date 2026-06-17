<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class TutorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Schema::disableForeignKeyConstraints();
    }

    public function test_semua_fitur_tutor_controller()
    {
        // FIX: Lengkapi data dummy
        DB::table('kategori')->insert(['idkategori' => 1, 'namakategori' => 'Eksakta']);
        DB::table('matakuliah')->insert(['idmatkul' => '1', 'idkategori' => 1, 'namamatkul' => 'Matkul A']);
        DB::table('tutor')->insert(['idtutor' => '1', 'nama' => 'Tutor A', 'pekerjaan' => 'Dosen', 'fototutor' => '']);

        DB::table('sesi')->insert([
            'idsesi' => 1, 'idtutor' => '1', 'idmatkul' => '1', 'namaSesi' => 'Sesi A', 'harga' => 50000
        ]);

        DB::table('user')->insert(['userid' => 1, 'username' => 'User1', 'email' => 'a@b.com', 'password' => '123', 'nomorhp' => '123']);
        DB::table('pesanan')->insert(['idpesanan' => 1, 'idsesi' => 1, 'userid' => 1, 'tanggal' => now(), 'jam' => '10:00']);
        DB::table('review')->insert(['idreview' => 1, 'idpesanan' => 1, 'rating' => 5, 'komentar' => 'Sangat bagus!']);

        $this->get('/tutor')->assertStatus(200);
        $this->get('/tutor/1')->assertStatus(200);
        $this->get('/tutor/999')->assertStatus(404);
        $this->get('/tutor/1/sesi')->assertStatus(200);
        $this->get('/tutor/999/sesi')->assertStatus(404);
    }
}
