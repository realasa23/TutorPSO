<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Nailah Adlina (5026231068)

class KategoriController extends Controller
{
    public function kategori()
    {
        $kategori = DB::table('kategori')
            ->select('kategori.*')
            ->selectRaw('(SELECT COUNT(*) FROM matakuliah WHERE matakuliah.idkategori = kategori.idkategori) as total_materi')
            ->get();
        return view('KATEGORI', compact('kategori'));
    }
}