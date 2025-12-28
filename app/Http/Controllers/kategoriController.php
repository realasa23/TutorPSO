<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Nailah Adlina (5026231068)

class kategoriController extends Controller
{
    public function kategori()
    {
      $kategori = DB::table('kategori')
            ->leftJoin('matakuliah', 'kategori.idkategori', '=', 'matakuliah.idkategori')
            ->select(
                'kategori.idkategori',
                'kategori.namakategori',
                DB::raw('COUNT(matakuliah.idmatkul) as total_materi')
            )
            ->groupBy('kategori.idkategori', 'kategori.namakategori')
            ->get();

        return view('Kategori', compact('kategori'));
    }
}
