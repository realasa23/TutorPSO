<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MatakuliahTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_bisa_melihat_daftar_materi()
    {
        $idkategori = DB::table('kategori')->insertGetId([
            'namakategori' => 'Pemrograman',
        ]);

        DB::table('matakuliah')->insert([
            'namamatkul' => 'Laravel',
            'idkategori' => $idkategori,
        ]);

        $response = $this->get("/kategori/$idkategori/materi");

        $response->assertStatus(200);
    }
}