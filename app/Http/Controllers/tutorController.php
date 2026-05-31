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
        return view('List-Tutor', compact('tutor'));
    }

    // FUNGSI INI TADI KETIDAKSENGAJAAN KEHAPUS, GUE BALIKIN TAPI PAKE LOGIC DATABASE YAK
    public function profile($id)
    {
        $tutor = DB::table('tutor')->where('idtutor', $id)->first();
        // sementara review dikosongin dulu biar nggak error karena tabel review lu masih 0
        $reviews = collect([]); 
        return view('Profile-Tutor', compact('tutor', 'reviews'));
    }

    // FUNGSI INI JUGA TADI KEHAPUS
    public function listSesi($idtutor)
    {
        $tutor = DB::table('tutor')->where('idtutor', $idtutor)->first();
        $sesi = DB::table('sesi')->where('idtutor', $idtutor)->get();
        return view('Daftar-Sesi-Tutor', compact('tutor', 'sesi'));
    }
}