<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Harya Raditya Handoyo - 5026231176
// Nailah Adlina - 5026231068

class SesiController extends Controller
{
    public function listSesi($idmatkul)
    {
        $matakuliah = DB::table('matakuliah')->where('idmatkul', $idmatkul)->first();
        if (!$matakuliah) {
            abort(404, 'Matakuliah tidak ditemukan');
        }

        $sesi = DB::table('sesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->leftJoin('pesanan', 'sesi.idsesi', '=', 'pesanan.idsesi')
            ->leftJoin('review', 'pesanan.idpesanan', '=', 'review.idpesanan')
            ->where('sesi.idmatkul', $idmatkul)
            ->select(
                'sesi.idsesi',
                'sesi.idtutor',
                'sesi.idmatkul',
                'sesi.namaSesi',
                'sesi.harga',
                'tutor.nama',
                'tutor.fototutor',
                DB::raw('COALESCE(AVG(review.rating), 0) as ratingtutor')
            )
            ->groupBy(
                'sesi.idsesi', 'sesi.idtutor', 'sesi.idmatkul',
                'sesi.namaSesi', 'sesi.harga',
                'tutor.nama', 'tutor.fototutor'
            )
            ->get();

        // Header blade ini butuh $tutor->nama dan $tutor->fototutor secara global.
        // Karena view ini juga dipakai TutorController::listSesi (1 tutor banyak sesi),
        // di sini kita ambil data tutor dari baris pertama sebagai representasi.
        $tutor = $sesi->isNotEmpty()
            ? (object) ['nama' => $sesi->first()->nama, 'fototutor' => $sesi->first()->fototutor]
            : (object) ['nama' => $matakuliah->namamatkul, 'fototutor' => null];

        return view('Daftar-Sesi-Tutor', compact('sesi', 'matakuliah', 'tutor'));
    }

    public function pesanSesi($idsesi)
    {
        $sesi = DB::table('sesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('sesi.idsesi', $idsesi)
            ->select('sesi.*', 'tutor.nama', 'tutor.fototutor')
            ->first();

        if (!$sesi) {
            abort(404, 'Sesi tidak ditemukan');
        }

        $bookedDates = DB::table('pesanan')
            ->where('idsesi', $idsesi)
            ->pluck('tanggal')
            ->map(fn($t) => (string) $t)
            ->toArray();

        return view('Pemilihan-Tanggal', compact('sesi', 'bookedDates'));
    }

    public function pilihTanggalStore(Request $request, $idsesi)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
        ]);

        session(['tanggal' => $request->tanggal]);

        return redirect()->route('pesanan.jam', ['idsesi' => $idsesi]);
    }

    public function pilihJam($idsesi)
    {
        $tanggal = session('tanggal');
        if (!$tanggal) {
            return redirect()->route('pesanan.tanggal', ['idsesi' => $idsesi]);
        }

        $sesi = DB::table('sesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('sesi.idsesi', $idsesi)
            ->select('sesi.*', 'tutor.nama', 'tutor.fototutor')
            ->first();

        if (!$sesi) {
            abort(404, 'Sesi tidak ditemukan');
        }

        $jamTerbooking = DB::table('pesanan')
            ->where('idsesi', $idsesi)
            ->where('tanggal', $tanggal)
            ->pluck('jam')
            ->toArray();

        return view('Pemilihan-Jam', compact('sesi', 'tanggal', 'jamTerbooking'));
    }

    public function pilihJamStore(Request $request, $idsesi)
    {
        $request->validate([
            'jam' => 'required|string',
        ]);

        session(['jam' => $request->jam]);

        return redirect()->route('pesanan.detail', ['idsesi' => $idsesi]);
    }

    public function lihatDetailPesanan($idsesi)
    {
        $tanggal = session('tanggal');
        $jam     = session('jam');

        if (!$tanggal || !$jam) {
            return redirect()->route('pesanan.tanggal', ['idsesi' => $idsesi]);
        }

        $sesi = DB::table('sesi')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('sesi.idsesi', $idsesi)
            ->select('sesi.*', 'matakuliah.namamatkul', 'tutor.nama', 'tutor.fototutor')
            ->first();

        if (!$sesi) {
            abort(404, 'Sesi tidak ditemukan');
        }

        return view('Detail-Pesanan', compact('sesi', 'tanggal', 'jam'));
    }
}