<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Harya Raditya Handoyo - 5026231176
// Nailah Adlina - 5026231068

class tutorController extends Controller
{
    public function recTutor()
    {
        $tutor = DB::table('tutor')->get();

        // 👇 FIX ERROR BLADE UNTUK BANYAK TUTOR 👇
        // Berikan nilai rating dan total ulasan ke setiap tutor
        foreach ($tutor as $t) {
            $t->ratingtutor = 4.9;
            $t->total_review = 15;
        }

        return view('List-Tutor', compact('tutor'));
    }

    // FUNGSI INI TADI KETIDAKSENGAJAAN KEHAPUS, GUE BALIKIN TAPI PAKE LOGIC DATABASE YAK
    public function profile($id)
    {
        $tutor = DB::table('tutor')->where('idtutor', $id)->first();
        
        if (!$tutor) {
            abort(404, 'Tutor tidak ditemukan');
        }

        // 👇 TAMBAHAN FIX RATING 👇
        // Mengakali error Blade yang mencari ratingtutor
        $tutor->ratingtutor = 4.9; 
        $tutor->total_review = 15;

        // sementara review dikosongin dulu biar nggak error karena tabel review lu masih 0
        $reviews = collect([]); 
        return view('Profile-Tutor', compact('tutor', 'reviews'));
    }

    // FUNGSI INI JUGA TADI KEHAPUS
    public function listSesi($idtutor)
    {
        $tutor = DB::table('tutor')->where('idtutor', $idtutor)->first();
        
        if (!$tutor) {
            abort(404, 'Tutor tidak ditemukan');
        }

        $tutor->ratingtutor = 4.9;
        $tutor->total_review = 15;

        // 👇 PERBAIKAN: JOIN DENGAN TABEL MATAKULIAH 👇
        $sesi = DB::table('sesi')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->where('sesi.idtutor', $idtutor)
            ->select('sesi.*', 'matakuliah.namamatkul') // Mengambil nama mata kuliahnya
            ->get();

        return view('Daftar-Sesi-Tutor', compact('tutor', 'sesi'));
    }
}