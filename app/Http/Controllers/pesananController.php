<?php

namespace App\Http\Controllers;
use App\Models\Sesi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

//Nailah Adlina - 5026231068
//Mirna Irawan - 5026221192

class pesananController extends Controller
{
    public function storeRegular(Request $request)
    {
        // BYPASS: Langsung redirect ke view tanpa insert DB
        return view('Konfirmasi-Pesanan');
    }

    public function storeTrial(Request $request)
    {
        // BYPASS: Langsung redirect ke view tanpa insert DB
        return view('Konfirmasi-Trial');
    }

    private function tentukanStatusTanggal($tanggal, $jam, $durasi = 50, $waktuSelesai = null)
    {
        // Fungsi helper dibiarkan statis, tidak memicu query DB
        if ($waktuSelesai) {
            return 'lampau';
        }

        $jamMulai = explode('-', $jam)[0];
        $jamMulai = trim(str_replace('.', ':', $jamMulai));

        $startAsli = Carbon::createFromFormat('Y-m-d H:i', "$tanggal $jamMulai");
        $start = $startAsli->copy()->subMinutes(5);
        $end = $startAsli->copy()->addMinutes($durasi);
        $now = Carbon::now();

        if ($now->lt($start)) return 'akan-datang';
        if ($now->between($start, $end)) return 'berlangsung';
        return 'lampau';
    }


    public function gabungSesi($idpesanan)
    {
        // BYPASS: Bikin object pesanan palsu (dummy) biar view Sesi-Berlangsung gak error
        $pesanan = (object) [
            'idpesanan' => $idpesanan,
            'userid' => session('user_id'),
            'namaSesi' => 'Sesi Dummy',
            'nama_tutor' => 'Tutor Dummy'
        ];

        return view('Sesi-Berlangsung', compact('pesanan'));
    }

    public function endCall($idpesanan)
    {
        // BYPASS: Langsung redirect tanpa update tabel
        return redirect()->route('aktivitas', ['tab' => 'lampau']);
    }


    public function aktivitas(Request $request)
    {
        $allowedTabs = ['akan-datang', 'berlangsung', 'lampau'];
        $tab = in_array($request->tab, $allowedTabs)
            ? $request->tab
            : 'akan-datang';

        // BYPASS: Return collection kosong supaya foreach di view gak error
        $sesi = collect([]);

        return view('Aktivitas', [
            'sesi' => $sesi,
            'tab'  => $tab
        ]);
    }

    public function detail($idpesanan)
    {
        // BYPASS: Bikin data pesanan palsu supaya halaman detail bisa kerender
        $pesanan = (object) [
            'idpesanan' => $idpesanan,
            'tanggal_pesanan' => date('Y-m-d'),
            'jam_pesanan' => '10.00-10.50',
            'biaya' => 50000,
            'namaSesi' => 'Materi Dummy',
            'harga' => 50000,
            'filemateri' => null,
            'rekamankelas' => null,
            'deskripsi' => 'Ini adalah detail pesanan dummy untuk testing.',
            'nama_tutor' => 'Budi Tutor',
            'fototutor' => null,
            'namamatkul' => 'Kalkulus'
        ];

        $statusRealtime = 'akan-datang';

        return view('Detail-Aktivitas', compact('pesanan', 'statusRealtime'));
    }
}