<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Nailah Adlina - 5026231068

class matakuliahController extends Controller
{
    public function materi($idkategori)
    {
        // Kodingan Asli Nembak Database
        $kategori = DB::table('kategori')
            ->where('idkategori', $idkategori)
            ->first();

        $matakuliah = DB::table('matakuliah as m')
            ->select('m.*') 
            // Menghitung jumlah sesi berdasarkan idmatkul
            ->selectRaw('(SELECT COUNT(*) FROM sesi WHERE sesi.idmatkul = m.idmatkul) as jumlah_sesi')
            ->where('m.idkategori', $idkategori) // Sesuaikan variabel $idkategori ini dengan yang ada di controllermu
            ->get();

        return view('List-Materi', compact('kategori', 'matakuliah'));
    }
}