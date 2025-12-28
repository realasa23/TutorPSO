<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Sesi;
use App\Models\Pesanan;

//Nailah Adlina - 5026231068

class sesiController extends Controller
{

    public function listSesi($idmatkul)
    {
        $matakuliah = DB::table('matakuliah')
            ->where('idmatkul', $idmatkul)
            ->first();

        $sesi = DB::table('sesi as s')
            ->join('tutor as t', 't.idtutor', '=', 's.idtutor')
            ->join('matakuliah as m', 'm.idmatkul', '=', 's.idmatkul')
            ->leftJoin('pesanan as p', 'p.idsesi', '=', 's.idsesi')
            ->leftJoin('review as r', 'r.idpesanan', '=', 'p.idpesanan')
            ->where('s.idmatkul', $idmatkul)
            ->select(
                's.idsesi',
                's.namaSesi',
                's.tanggal',
                's.jam',
                's.harga',
                'm.namamatkul',
                't.idtutor',
                't.nama',
                't.fototutor',
                't.pekerjaan',
                DB::raw('COALESCE(AVG(r.rating),0) as ratingtutor'),
            )
            ->groupBy(
                's.idsesi',
                's.namaSesi',
                's.tanggal',
                's.jam',
                's.harga',
                'm.namamatkul',
                't.idtutor',
                't.nama',
                't.fototutor',
                't.pekerjaan'
            )
            ->orderBy('s.tanggal', 'asc')
            ->get();

        return view('List-SesiTutor', compact('matakuliah', 'sesi'));
    }


    public function pesanSesi($idsesi)
    {
        $sesi = Sesi::with(['tutor', 'matakuliah'])
            ->where('idsesi', $idsesi)
            ->firstOrFail();

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
        $tanggal = session('tanggal_pesanan');

        if (!$tanggal) {
            return redirect()->route('pesanan.tanggal', $idsesi)
                            ->with('error', 'Silakan pilih tanggal terlebih dahulu.');
        }

        $sesi = Sesi::findOrFail($idsesi);
    
        $jamTerbooking = Pesanan::where('idsesi', $idsesi)
                        ->where('tanggal', $tanggal)
                        ->pluck('jam')
                        ->toArray();

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