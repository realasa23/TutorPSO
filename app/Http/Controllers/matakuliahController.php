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

        $matakuliah = DB::table('matakuliah')
            ->where('idkategori', $idkategori)
            ->get();

        return view('List-Materi', compact('kategori', 'matakuliah'));
    }
}