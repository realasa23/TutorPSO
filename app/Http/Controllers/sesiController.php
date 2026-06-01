<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

// Nailah Adlina - 5026231068

class sesiController extends Controller
{
    public function listSesi($idmatkul)
    {
        $matakuliah = (object) ['idmatkul' => $idmatkul, 'namamatkul' => 'Matkul Dummy'];
        
        // Dummy sesi biar ada isinya
        $sesi = collect([
            (object)[
                'idsesi' => 1, 'namaSesi' => 'Sesi Dummy 1', 'harga' => 50000, 
                'namamatkul' => 'Matkul Dummy', 'idtutor' => 1, 'nama' => 'Sasha', 
                'fototutor' => 'https://ui-avatars.com/api/?name=Sasha&background=random', 
                'pekerjaan' => 'PWEB Developer', 'ratingtutor' => 4.9
            ]
        ]);
        return view('List-SesiTutor', compact('matakuliah', 'sesi'));
    }

    public function pesanSesi($idsesi)
    {
        $sesi = (object) [
            'idsesi' => $idsesi, 
            'namaSesi' => 'Sesi Dummy', 
            'harga' => 50000, 
            'tipe' => 'online', // FIX 1: Penambahan tipe agar badge online/offline muncul
            'tutor' => (object)[
                'nama' => 'Sasha', 
                'fototutor' => 'https://ui-avatars.com/api/?name=Sasha&background=random'
            ], 
            'matakuliah' => (object)['namamatkul' => 'Matkul Dummy']
        ];
        $bookedDates = [];
        return view('Pemilihan-Tanggal', compact('sesi', 'bookedDates'));
    }

    public function pilihTanggalStore(Request $request)
    {
        session(['tanggal_pesanan' => $request->tanggal ?? '2026-05-31']);
        return redirect()->route('pesanan.jam', ['idsesi' => $request->route('idsesi')]);
    }

    public function pilihJam($idsesi)
    {
        $tanggal = session('tanggal_pesanan') ?? '2026-05-31';
        $sesi = (object) [
            'idsesi' => $idsesi, 
            'namaSesi' => 'Sesi Dummy',
            'tipe' => 'online',
            'tutor' => (object)[
                'nama' => 'Sasha', 
                'fototutor' => 'https://ui-avatars.com/api/?name=Sasha&background=random'
            ]
        ];
        $jamTerbooking = [];
        return view('Pemilihan-Jam', compact('sesi', 'tanggal', 'jamTerbooking'));
    }

    public function pilihJamStore(Request $request)
    {
        session(['jam_pesanan' => $request->jam ?? '10:00']);
        return redirect()->route('pesanan.detail', ['idsesi' => session('idsesi') ?? 1]);
    }

    public function lihatDetailPesanan($idsesi)
    {
        $tanggal = session('tanggal_pesanan') ?? '2026-05-31';
        $jam     = session('jam_pesanan') ?? '10:00';
        $sesi = (object) [
            'idsesi' => $idsesi, 
            'namaSesi' => 'Sesi Dummy', 
            'harga' => 50000,
            'tipe' => 'online', 
            'tutor' => (object)[
                'nama' => 'Sasha',
                'fototutor' => 'https://ui-avatars.com/api/?name=Sasha&background=random' // FIX 2: Penambahan fototutor untuk halaman akhir
            ], 
            'matakuliah' => (object)['namamatkul' => 'Matkul Dummy']
        ];
        return view('Detail-Pesanan', compact('sesi', 'tanggal', 'jam'));
    }
}