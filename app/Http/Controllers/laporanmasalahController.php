<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\laporanmasalah;
use App\Models\Refund;
use App\Models\user; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Tambahkan ini jika menggunakan Auth bawaan Laravel

//Michelle Lea Amanda - 5026231214
//Nailah Adlina - 5026231068

class laporanmasalahController extends Controller
{
    public function create($idpesanan)
    {
        // PENGAMBILAN USER ID ASLI:
        // Jika pakai session manual, gunakan: session('user_id')
        // Jika pakai Auth bawaan Laravel, gunakan: Auth::id()
        $userId = session('user_id') ?? Auth::id(); 
        
        // Jika user belum login, tendang ke halaman login
        if (!$userId) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid', $userId)
            ->select(
                'pesanan.idpesanan',
                'pesanan.idsesi',
                'pesanan.tanggal',
                'pesanan.jam',
                'sesi.namaSesi as namasesi', 
                'tutor.nama as nama_tutor',
                'tutor.fototutor'
            )
            ->first();

        if (!$pesanan) {
            abort(404);
        }

        $sudahLapor = DB::table('laporanmasalah')
            ->where('idsesi', $pesanan->idsesi) 
            ->exists();

        if ($sudahLapor) {
            return redirect()
                ->route('history.laporan')
                ->with('error', 'Anda sudah mengirim laporan untuk ini.');
        }

        return view('Laporan-Masalah', compact('pesanan'));
    }

    public function detailMasalah(Request $request, $idpesanan)
    {
        $jenisMasalah = $request->query('jenis');
        $idpesanan = $request->route('idpesanan');

        if (!$jenisMasalah || !$idpesanan) {
            abort(404);
        }

        // PENGAMBILAN USER ID ASLI
        $userId = session('user_id') ?? Auth::id(); 
        
        if (!$userId) {
            return redirect('/login');
        }

        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid', $userId)
            ->select(
                'pesanan.idpesanan',
                'pesanan.tanggal',
                'pesanan.jam',
                'sesi.namaSesi as namasesi', 
                'tutor.nama as nama_tutor',
                'tutor.fototutor'
            )
            ->first();

        if (!$pesanan) {
            abort(404);
        }

        return view('Laporan-Detail-Masalah', compact('pesanan', 'jenisMasalah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpesanan' => 'required|integer',
            'jenis_masalah' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        // PENGAMBILAN USER ID ASLI
        $userId = session('user_id') ?? Auth::id(); 

        $pesanan = DB::table('pesanan')
            ->where('idpesanan', $request->idpesanan)
            ->where('userid', $userId)
            ->first();

        if (!$pesanan) {
            abort(403);
        }

        $isRefund = in_array(
            $request->jenis_masalah,
            ['Tutor Tidak Hadir', 'Kesalahan Jadwal']
        );

        $idlaporan = DB::table('laporanmasalah')->insertGetId([
            'userid'            => $userId,
            'idsesi'            => $pesanan->idsesi, 
            'kategorimasalah'   => $request->jenis_masalah,
            'deskripsimasalah'  => $request->deskripsi,
            'statuslaporan'     => $isRefund
                ? 'Refund_Diajukan'
                : 'Laporan_Diterima',
            'created_at'        => now(),
            'updated_at'        => now(),
        ], 'idlaporan'); // <--- TAMBAHKAN KATA 'idlaporan' DI SINI

        if ($isRefund) {
            DB::table('refund')->insert([
                'idlaporan'          => $idlaporan,
                'statusrefund'       => 'Diproses',
                'jumlahpengembalian' => $pesanan->biaya,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }

        return redirect()
            ->route('laporan.selesai')
            ->with('type', $isRefund ? 'refund' : 'laporan');
    }

    public function laporanSukses(Request $request)
    {
        return view('Laporan-Berhasil', [
            'type' => session('type')
        ]);
    }
}