<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Michelle Lea Amanda - 5026231214
// Nailah Adlina       - 5026231068
class ReviewController extends Controller
{
    public function reviewTutor($idpesanan)
    {
        $userId = session('user_id') ?? Auth::id();
        if (!$userId) return redirect('/login');

        $pesanan = DB::table('pesanan')
            ->join('sesi',       'pesanan.idsesi',  '=', 'sesi.idsesi')
            ->join('tutor',      'sesi.idtutor',    '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul',   '=', 'matakuliah.idmatkul')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid',    $userId)
            ->select(
                'pesanan.idpesanan',
                'tutor.idtutor',
                'tutor.nama as nama_tutor',
                'tutor.fototutor',
                'sesi.namaSesi as namasesi',
                'matakuliah.namamatkul'
            )
            ->first();

        if (!$pesanan) abort(404, 'Data pesanan tidak ditemukan atau bukan milik Anda.');

        // Cegah review dobel
        if (DB::table('review')->where('idpesanan', $idpesanan)->exists()) {
            return redirect()
                ->route('profiletutor', ['id' => $pesanan->idtutor])
                ->with('error', 'Kamu sudah memberikan review untuk sesi ini.');
        }

        return view('Review', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpesanan'    => 'required|integer',
            'rating'       => 'required|integer|min:1|max:5',
            'tagpenilaian' => 'nullable|string|max:255',
            'komentar'     => 'nullable|string|max:1000',
        ]);

        $userId = session('user_id') ?? Auth::id();
        if (!$userId) return redirect('/login');

        // Pastikan pesanan milik user ini
        $pesanan = DB::table('pesanan')
            ->where('idpesanan', $request->idpesanan)
            ->where('userid',    $userId)
            ->first();

        if (!$pesanan) abort(403, 'Aksi tidak diizinkan.');

        // Double-check: cegah review dobel lewat form manipulation
        if (DB::table('review')->where('idpesanan', $request->idpesanan)->exists()) {
            return back()->with('error', 'Kamu sudah mengulas sesi ini.');
        }

        DB::table('review')->insert([
            'idpesanan'    => $request->idpesanan,
            'rating'       => $request->rating,
            'tagpenilaian' => $request->tagpenilaian,
            'komentar'     => $request->komentar,
            'tanggalreview' => now(),
        ]);

        return view('Review-Selesai');
    }
}