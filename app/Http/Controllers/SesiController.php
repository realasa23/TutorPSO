<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Harya Raditya Handoyo - 5026231176
// Nailah Adlina - 5026231068

class SesiController extends Controller
{
    public function index()
    {
        $sesi = DB::table('sesi')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->select('sesi.*', 'matakuliah.namamatkul', 'tutor.nama as namatutor')
            ->get();

        return view('Daftar-Sesi', compact('sesi'));
    }

    public function show($id)
    {
        $sesi = DB::table('sesi')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('sesi.idsesi', $id)
            ->select('sesi.*', 'matakuliah.namamatkul', 'tutor.nama as namatutor')
            ->first();

        if (!$sesi) {
            abort(404, 'Sesi tidak ditemukan');
        }

        return view('Detail-Sesi', compact('sesi'));
    }
}