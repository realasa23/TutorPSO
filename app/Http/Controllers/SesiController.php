<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Harya Raditya Handoyo - 5026231176
// Nailah Adlina - 5026231068

class SesiController extends Controller
{
    public function listSesi($idmatkul)
    {
        $matkul = DB::table('matakuliah')->where('idmatkul', $idmatkul)->first();
        if (!$matkul) {
            abort(404, 'Matakuliah tidak ditemukan');
        }

        $sesi = DB::table('sesi')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('sesi.idmatkul', $idmatkul)
            ->select('sesi.*', 'matakuliah.namamatkul', 'tutor.nama as namatutor', 'tutor.fototutor')
            ->get();

        return view('Daftar-Sesi-Tutor', compact('sesi', 'matkul'));
    }

    public function index()
    {
        $sesi = DB::table('sesi')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->select('sesi.*', 'matakuliah.namamatkul', 'tutor.nama as namatutor')
            ->get();

        return view('Daftar-Sesi-Tutor', compact('sesi'));
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

        return view('Detail-Aktivitas', compact('sesi'));
    }

    public function pesanSesi($idsesi)
    {
        $sesi = DB::table('sesi')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('sesi.idsesi', $idsesi)
            ->select('sesi.*', 'matakuliah.namamatkul', 'tutor.nama as namatutor')
            ->first();

        if (!$sesi) {
            abort(404, 'Sesi tidak ditemukan');
        }

        return view('Pemilihan-Tanggal', compact('sesi'));
    }

    public function pilihTanggalStore(Request $request, $idsesi)
    {
        $request->validate([
            'tanggal' => 'required|date',
        ]);

        return redirect()->route('pesanan.jam', ['idsesi' => $idsesi])
            ->with('tanggal', $request->tanggal);
    }

    public function pilihJam($idsesi)
    {
        $sesi = DB::table('sesi')->where('idsesi', $idsesi)->first();
        if (!$sesi) {
            abort(404, 'Sesi tidak ditemukan');
        }

        $tanggal = session('tanggal');

        return view('Pemilihan-Jam', compact('sesi', 'tanggal'));
    }

    public function pilihJamStore(Request $request, $idsesi)
    {
        $request->validate([
            'jam' => 'required',
        ]);

        session(['jam' => $request->jam]);

        return redirect()->route('pesanan.detail', ['idsesi' => $idsesi]);
    }

    public function lihatDetailPesanan($idsesi)
    {
        $sesi = DB::table('sesi')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('sesi.idsesi', $idsesi)
            ->select('sesi.*', 'matakuliah.namamatkul', 'tutor.nama as namatutor', 'tutor.fototutor')
            ->first();

        if (!$sesi) {
            abort(404, 'Sesi tidak ditemukan');
        }

        $tanggal = session('tanggal');
        $jam     = session('jam');

        return view('Detail-Pesanan', compact('sesi', 'tanggal', 'jam'));
    }
}