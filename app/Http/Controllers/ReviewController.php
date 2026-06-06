<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//Michelle Lea Amanda - 5026231214
//Nailah Adlina - 5026231068

class ReviewController extends Controller
{
    public function reviewTutor($idpesanan)
    {
        $userId = session('user_id') ?? Auth::id();
        if (!$userId) {
            return redirect('/login');
        }

        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid', $userId)
            ->select(
                'pesanan.idpesanan',
                'tutor.idtutor',
                'tutor.nama as nama_tutor',
                'tutor.fototutor',
                'sesi.namaSesi as namasesi',
                'matakuliah.namamatkul'
            )
            ->first();

        if (!$pesanan) {
            abort(404, 'Data pesanan tidak ditemukan atau bukan milik Anda.');
        }

        $sudahReview = DB::table('review')
            ->where('idpesanan', $idpesanan)
            ->exists();

        if ($sudahReview) {
            return redirect()
                ->route('profiletutor', ['id' => $pesanan->idtutor])
                ->with('error', 'Anda sudah memberikan review untuk sesi ini.');
        }

        return view('Review', compact('pesanan')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpesanan'     => 'required|integer',
            'rating'        => 'required|integer|min:1|max:5',
            'tagpenilaian'  => 'nullable|string',
            'komentar'      => 'nullable|string',
        ]);

        $userId = session('user_id') ?? Auth::id();

        $pesananValid = DB::table('pesanan')
            ->where('idpesanan', $request->idpesanan)
            ->where('userid', $userId)
            ->exists();

        if (!$pesananValid) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        DB::table('review')->insert([
            'idpesanan'     => $request->idpesanan,
            'rating'        => $request->rating,
            'tagpenilaian'  => $request->tagpenilaian,
            'komentar'      => $request->komentar,
            'tanggalreview' => now(),
        ]);

        return view('Review-Selesai');
    }
}