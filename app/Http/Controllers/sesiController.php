<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

// Nailah Adlina - 5026231068

class sesiController extends Controller
{
    public function listSesi($idmatkul)
    {
        $matakuliah = DB::table('matakuliah')->where('idmatkul', $idmatkul)->first();
        
        // Narik dari DB + Join ke tabel tutor biar dapet nama & foto
        $sesi = DB::table('sesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('sesi.idmatkul', $idmatkul)
            ->get();
            
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
        $sesi = DB::table('sesi')->where('idsesi', $idsesi)->first();
        $jamTerbooking = [];
        return view('Pemilihan-Jam', compact('sesi', 'tanggal', 'jamTerbooking'));
    }

    public function pilihJamStore(Request $request, $idsesi)
    {
        session(['jam_pesanan' => $request->jam ?? '10:00']);
        return redirect()->route('pesanan.detail', ['idsesi' => $idsesi]);
    }

    public function lihatDetailPesanan($idsesi)
    {
        $tanggal = session('tanggal_pesanan') ?? '2026-05-31';
        $jam     = session('jam_pesanan') ?? '10:00';
        
        // Narik detail DB buat halaman konfirmasi
        $sesi = DB::table('sesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->where('sesi.idsesi', $idsesi)
            ->first();
            
        return view('Detail-Pesanan', compact('sesi', 'tanggal', 'jam'));
    }
}