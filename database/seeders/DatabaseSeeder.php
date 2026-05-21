<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Pastikan baris ini ditambahkan

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
        ]);
    }
}