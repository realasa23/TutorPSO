<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

//Michelle Lea Amanda (5026231214)
//Nailah Adlina (5026231068)

class reviewController extends Controller
{
    public function reviewTutor($idpesanan)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid', $userId)
            ->select(
                'pesanan.idpesanan',
                'pesanan.status',
                'tutor.nama as nama_tutor',
                'tutor.idtutor',
                'tutor.fototutor'
            )
            ->first();

        if (!$pesanan) {
            abort(404);
        }

        $sudahReview = DB::table('review')
        ->where('idpesanan', $idpesanan)->exists();

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
