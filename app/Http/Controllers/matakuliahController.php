<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Nailah Adlina (5026231068)

class matakuliahController extends Controller
{
    public function materi($idkategori)
    {
        $kategori = DB::table('kategori')
            ->where('idkategori', $idkategori)
            ->first();

        $matakuliah = DB::table('matakuliah as m')
            ->leftJoin('sesi as s', 's.idmatkul', '=', 'm.idmatkul')
            ->where('m.idkategori', $idkategori)
            ->select(
                'm.idmatkul',
                'm.namamatkul',
                DB::raw('COUNT(s.idsesi) as jumlah_sesi')
            )
            ->groupBy('m.idmatkul', 'm.namamatkul')
            ->get();

        return view('List-Materi', compact(
            'kategori',
            'matakuliah'
        ));
    }
}
