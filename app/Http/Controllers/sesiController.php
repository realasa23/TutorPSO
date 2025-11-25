<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SesiController extends Controller
{
    public function detailAkanDatang()
    {
        // 1. Asumsi data sesi diambil dari database
        //    (Di sini kita menggunakan data dummy/statis)
        $sesi = [
            'pengajar' => 'Khalila',
            'materi' => 'Dasar Pemrograman',
            'rating' => 4.9,
            'harga' => 50000,
            'pertemuan' => 'Pertemuan 1 Object Oriented Programming',
            'tanggal' => '4 Agustus 2024',
            'waktu' => '16.00-16.50 WIB',
            'deskripsi' => 'OOP Java (Object-Oriented Programming in Java) adalah paradigma pemrograman yang menggunakan konsep objek dan kelas untuk merancang dan membangun program.',
            // 'materi_file' => '/path/to/materi.pdf', // Contoh link unduhan
        ];
        return view('DetailSesi-AkanDatang', compact('sesi'));
    }

    public function detailBerlangsung()
    {
        $sesi = [
            'pengajar' => 'Khalila',
            'materi' => 'Dasar Pemrograman',
            'rating' => 4.9,
            'harga' => 50000,
            'pertemuan' => 'Pertemuan 1 Object Oriented Programming',
            'tanggal' => '4 Agustus 2024',
            'waktu' => '16.00-16.50 WIB',
            'deskripsi' => 'OOP Java (Object-Oriented Programming in Java) adalah paradigma pemrograman yang menggunakan konsep objek dan kelas untuk merancang dan membangun program.',
    ];

    return view('DetailSesi-Berlangsung', compact('sesi'));
    }

    public function detailLampau()
    {
        $sesi = [
            'pengajar' => 'Khalila',
            'materi' => 'Dasar Pemrograman',
            'rating' => 4.9,
            'harga' => 50000,
            'pertemuan' => 'Pertemuan 1 Object Oriented Programming',
            'tanggal' => '4 Agustus 2024',
            'waktu' => '16.00-16.50 WIB',
            'deskripsi' => 'OOP Java (Object-Oriented Programming in Java) adalah paradigma pemrograman yang menggunakan konsep objek dan kelas untuk merancang dan membangun program.',
    ];

    return view('DetailSesi-Lampau', compact('sesi'));
    }

    public function lihatDetailPesanan(){
        return view('Detail-Pesanan');
    }

    public function pesanSesi(){
        return view('Pemilihan-Tanggal');
    }

    public function pesanJamSesi(){
        return view('Pemilihan-Jam');
    }

}