<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Isi Tabel Kategori
        DB::table('kategori')->insert([
            ['idkategori' => 1, 'namakategori' => 'Pemrograman Web'],
            ['idkategori' => 2, 'namakategori' => 'Database & Graph (Neo4j)'],
            ['idkategori' => 3, 'namakategori' => 'Desain UI/UX'],
        ]);

        // 2. Isi Tabel Matakuliah (Butuh idkategori)
        DB::table('matakuliah')->insert([
            ['idmatkul' => 1, 'namamatkul' => 'Laravel Lanjut', 'idkategori' => 1],
            ['idmatkul' => 2, 'namamatkul' => 'Fundamental Neo4j', 'idkategori' => 2],
            ['idmatkul' => 3, 'namamatkul' => 'Figma Prototyping', 'idkategori' => 3],
        ]);

        // 3. Isi Tabel Tutor
        DB::table('tutor')->insert([
            ['idtutor' => 1, 'nama' => 'Sasha', 'pekerjaan' => 'PWEB Developer', 'fototutor' => 'https://ui-avatars.com/api/?name=Sasha&background=random'],
            ['idtutor' => 2, 'nama' => 'Haryadi', 'pekerjaan' => 'UX Design', 'fototutor' => 'https://ui-avatars.com/api/?name=Haryadi&background=random'],
            ['idtutor' => 3, 'nama' => 'Khalila', 'pekerjaan' => 'Data Analyst', 'fototutor' => 'https://ui-avatars.com/api/?name=Khalila&background=random'],
        ]);

        // 4. Isi Tabel Sesi (Butuh idtutor & idmatkul)
        DB::table('sesi')->insert([
            ['idsesi' => 1, 'idtutor' => 1, 'idmatkul' => 1, 'namaSesi' => 'Mentoring Laravel Backend', 'harga' => 50000],
            ['idsesi' => 2, 'idtutor' => 2, 'idmatkul' => 3, 'namaSesi' => 'Review Desain UI/UX', 'harga' => 35000],
            ['idsesi' => 3, 'idtutor' => 3, 'idmatkul' => 2, 'namaSesi' => 'Graph Database Cypher', 'harga' => 50000],
        ]);
    }
}