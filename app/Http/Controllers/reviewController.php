<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//Michelle Lea Amanda - 5026231214
//Nailah Adlina - 5026231068

class reviewController extends Controller
{
    public function reviewTutor($idpesanan)
    {
        // 1. Pengecekan User ID
        $userId = session('user_id') ?? Auth::id();
        if (!$userId) {
            return redirect('/login');
        }

        // 2. HAPUS BYPASS: Ambil data asli dari Database beserta relasinya
        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid', $userId) // Keamanan: pastikan ini milik user yang login
            ->select(
                'pesanan.idpesanan',
                'tutor.idtutor', // <--- INI PENTING agar redirect profiletutor tidak error
                'tutor.nama as nama_tutor',
                'tutor.fototutor',
                'sesi.namaSesi as namasesi', // Pakai alias huruf kecil untuk file Blade
                'matakuliah.namamatkul'
            )
            ->first();

        if (!$pesanan) {
            abort(404, 'Data pesanan tidak ditemukan atau bukan milik Anda.');
        }

        // 3. Pengecekan apakah sudah direview
        $sudahReview = DB::table('review')
            ->where('idpesanan', $idpesanan)
            ->exists();

        if ($sudahReview) {
            return redirect()
                ->route('profiletutor', ['id' => $pesanan->idtutor])
                ->with('error', 'Anda sudah memberikan review untuk sesi ini.');
        }

        // Pastikan nama view ini sesuai dengan file .blade.php kamu
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

        // Keamanan Ekstra: Pastikan user tidak mengirim ulasan untuk idpesanan orang lain
        $pesananValid = DB::table('pesanan')
            ->where('idpesanan', $request->idpesanan)
            ->where('userid', $userId)
            ->exists();

        if (!$pesananValid) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Insert data ke tabel review di Supabase
        DB::table('review')->insert([
            'idpesanan'     => $request->idpesanan,
            'rating'        => $request->rating,
            'tagpenilaian'  => $request->tagpenilaian,
            'komentar'      => $request->komentar,
            'tanggalreview' => now(), // Sesuai dengan kolom di database kamu
        ]);

        return view('Review-Selesai');
    }
}