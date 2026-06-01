<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use Illuminate\Support\Facades\DB; // Pastikan baris ini ditambahkan
>>>>>>> conf

class DatabaseSeeder extends Seeder
{
    public function run()
    {
<<<<<<< HEAD
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
=======
        // Menyuntikkan data ke tabel kategori
        DB::table('kategori')->insert([
            ['idkategori' => 1, 'namakategori' => 'Teknologi Informasi'],
            ['idkategori' => 2, 'namakategori' => 'Desain Komunikasi Visual'],
        ]);

        // Menyuntikkan data ke tabel tutor
        DB::table('tutor')->insert([
            [
                'idtutor' => 1,
                'nama' => 'Harya Raditya',
                'pekerjaan' => 'Software Engineer',
                'deskripsi' => 'Berpengalaman dalam pengembangan web dan keamanan siber.',
                'fototutor' => 'default.png' // Pastikan nama file ini sesuai dengan yang ada di folder public/storage kamu nantinya
            ],
            [
                'idtutor' => 2,
                'nama' => 'Mirna Irawan',
                'pekerjaan' => 'UI/UX Designer',
                'deskripsi' => 'Ahli dalam membuat prototipe desain aplikasi mobile yang interaktif.',
                'fototutor' => 'default.png'
            ]
        ]);

        // Menyuntikkan data ke tabel matakuliah
        DB::table('matakuliah')->insert([
            ['idmatkul' => 1, 'idkategori' => 1, 'namamatkul' => 'Pemrograman Web dengan Laravel'],
            ['idmatkul' => 2, 'idkategori' => 2, 'namamatkul' => 'Desain Antarmuka dengan Figma'],
>>>>>>> conf
        ]);
    }
}