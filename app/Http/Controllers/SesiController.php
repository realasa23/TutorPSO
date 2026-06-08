<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
 
// Nailah Adlina - 5026231068
class SesiController extends Controller
{
    public function listSesi($idmatkul)
    {
        $matakuliah = DB::table('matakuliah')->where('idmatkul', $idmatkul)->first();
        
        $sesi = DB::table('sesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->leftJoin('pesanan', 'sesi.idsesi', '=', 'pesanan.idsesi')
            ->leftJoin('review', 'pesanan.idpesanan', '=', 'review.idpesanan')
            ->where('sesi.idmatkul', $idmatkul)
            ->select(
                'sesi.idsesi',
                'sesi.idtutor',
                'sesi.idmatkul',
                'sesi.namaSesi',
                'sesi.harga',
                'sesi.tipe',
                'sesi.created_at',
                'sesi.updated_at',
                'tutor.nama',
                'tutor.fototutor',
                'tutor.pekerjaan',
                DB::raw('COALESCE(AVG(review.rating), 0) as ratingtutor'),
                DB::raw('COUNT(DISTINCT review.idreview) as total_review')
            )
            ->groupBy(
                'sesi.idsesi', 'sesi.idtutor', 'sesi.idmatkul',
                'sesi.namaSesi', 'sesi.harga', 'sesi.tipe',
                'sesi.created_at', 'sesi.updated_at',
                'tutor.nama', 'tutor.fototutor', 'tutor.pekerjaan'
            )
            ->get();
            
        return view('List-SesiTutor', compact('matakuliah', 'sesi'));
    }
 
    public function pesanSesi($idsesi)
    {
        $sesi = DB::table('sesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->where('sesi.idsesi', $idsesi)
            ->select('sesi.*', 'tutor.nama', 'tutor.fototutor', 'matakuliah.namamatkul')
            ->first();
 
        if (!$sesi) abort(404, 'Sesi tidak ditemukan');
 
        // Ambil tanggal yang sudah dibooking untuk sesi ini
        $bookedDates = DB::table('pesanan')
            ->where('idsesi', $idsesi)
            ->pluck('tanggal')
            ->toArray();
 
        return view('Pemilihan-Tanggal', compact('sesi', 'bookedDates'));
    }
 
    public function pilihTanggalStore(Request $request, $idsesi)
    {
        $request->validate(['tanggal' => 'required|date|after_or_equal:today']);
 
        session(['tanggal_pesanan' => $request->tanggal]);
        return redirect()->route('pesanan.jam', ['idsesi' => $idsesi]);
    }
 
    public function pilihJam($idsesi)
    {
        $tanggal = session('tanggal_pesanan');
        if (!$tanggal) return redirect()->route('pesanan.tanggal', ['idsesi' => $idsesi]);
 
        $sesi = DB::table('sesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->where('sesi.idsesi', $idsesi)
            ->select('sesi.*', 'tutor.nama', 'tutor.fototutor', 'matakuliah.namamatkul')
            ->first();
 
        if (!$sesi) abort(404, 'Sesi tidak ditemukan');
 
        // Jam yang sudah terbooking di tanggal yang dipilih
        $jamTerbooking = DB::table('pesanan')
            ->where('idsesi', $idsesi)
            ->where('tanggal', $tanggal)
            ->pluck('jam')
            ->toArray();
 
        return view('Pemilihan-Jam', compact('sesi', 'tanggal', 'jamTerbooking'));
    }
 
    public function pilihJamStore(Request $request, $idsesi)
    {
        $request->validate([
            'jam'    => 'required|string',
            'durasi' => 'required|integer|min:1|max:2', // 1 atau 2 jam
        ]);
 
        session([
            'jam_pesanan'    => $request->jam,
            'durasi_pesanan' => (int) $request->durasi,
        ]);
 
        return redirect()->route('pesanan.detail', ['idsesi' => $idsesi]);
    }
 
    public function lihatDetailPesanan($idsesi)
    {
        $tanggal = session('tanggal_pesanan');
        $jam     = session('jam_pesanan');
        $durasi  = session('durasi_pesanan', 1);
 
        if (!$tanggal || !$jam) {
            return redirect()->route('pesanan.tanggal', ['idsesi' => $idsesi]);
        }
 
        $sesi = DB::table('sesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->where('sesi.idsesi', $idsesi)
            ->first();
 
        if (!$sesi) abort(404, 'Sesi tidak ditemukan');
 
        return view('Detail-Pesanan', compact('sesi', 'tanggal', 'jam', 'durasi'));
    }
}
