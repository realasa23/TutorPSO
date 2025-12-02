<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Sesi;
use App\Models\Pesanan;

//Nailah Adlina - 5026231068
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

    

    public function pesanSesi($idsesi)
    {
        // Ambil data Sesi yang dipilih, eager load Tutor dan Matakuliah-nya.
        $sesi = Sesi::with(['tutor', 'matakuliah'])
            ->where('idsesi', $idsesi)
            ->firstOrFail();

        // Simpan ID sesi yang dipilih ke SESSION untuk digunakan pada langkah pemesanan berikutnya
        session(['idsesi' => $idsesi]);

        $bookedDates = Pesanan::where('idsesi', $idsesi)
                      ->pluck('tanggal')
                      ->toArray();


        return view('Pemilihan-Tanggal', compact('sesi', 'bookedDates'));
    }


    public function pilihTanggalStore(Request $request)
    {
        $request->validate([
            'tanggal' => 'required'
        ]);

        session(['tanggal_pesanan' => $request->tanggal]);

        $idsesi = $request->route('idsesi');

        return redirect()->route('pesanan.jam', ['idsesi' => $idsesi]);
    }

    public function pilihJam($idsesi)
    {
        $tanggal = session('tanggal_pesanan'); // ambil dari session

        if (!$tanggal) {
            return redirect()->route('pesanan.tanggal', $idsesi)
                            ->with('error', 'Silakan pilih tanggal terlebih dahulu.');
        }

        $sesi = Sesi::findOrFail($idsesi);
        
        $jamTerbooking = Pesanan::where('idsesi', $idsesi)
                        ->where('tanggal', $tanggal)
                        ->pluck('jam')
                        ->toArray();

        // $jamTersedia = Sesi::where('idsesi', $idsesi)
        //                     ->where('tanggal', $tanggal)
        //                     ->get();
        
        return view('Pemilihan-Jam', compact('sesi', 'tanggal', 'jamTerbooking'));
    }



    public function pilihJamStore(Request $request)
    {
        $request->validate([
            'jam' => 'required'
        ]);

        session(['jam_pesanan' => $request->jam]);

        $idsesi = session('idsesi'); // ← ambil dari session

        return redirect()->route('pesanan.detail', ['idsesi' => $idsesi]);
    }


    public function lihatDetailPesanan($idsesi)
    {
        $tanggal = session('tanggal_pesanan');
        $jam     = session('jam_pesanan');

        if (!$tanggal || !$jam) {
            return redirect()->route('pesanan.tanggal', $idsesi)
                            ->with('error', 'Data pesanan tidak lengkap.');
        }

        $sesi = Sesi::with(['tutor', 'matakuliah'])->findOrFail($idsesi);
        return view('Detail-Pesanan', compact('sesi', 'tanggal', 'jam'));
    }




}