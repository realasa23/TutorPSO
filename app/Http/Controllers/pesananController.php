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
        $idsesi   = session('idsesi');
        $tanggal  = session('tanggal_pesanan');
        $jam      = session('jam_pesanan');

        $userId = session('user_id');

        if (!$idsesi || !$tanggal || !$jam) {
            return redirect()->back()->with('error', 'Data pesanan tidak lengkap. Silakan ulangi pemesanan.');
        }

        $user = DB::table('user')->where('userid', $userId)->first();
        $sesi = Sesi::findOrFail($idsesi);

        Pesanan::create([
            'idsesi'           => $idsesi,
            'userid'           => $user->userid, 
            'tanggal'          => $tanggal,
            'jam'              => $jam,
            'biaya'            => $sesi->harga,
            'istrial'          => false,
            'statuspembayaran' => 'berhasil',
        ]);

        return view ('Konfirmasi-Pesanan');
    }

    public function storeTrial(Request $request)
    {
        $idsesi   = session('idsesi');
        $tanggal  = session('tanggal_pesanan');
        $jam      = session('jam_pesanan');
        $userId = session('user_id');
        $user = DB::table('user')->where('userid', $userId)->first();

        if (!$idsesi || !$tanggal || !$jam) {
            return redirect()->back()->with('error', 'Data pesanan tidak lengkap. Silakan ulangi pemesanan.');
        }

        if ($user->kuotatrial <= 0) {
            return redirect()->back()->with('error', 'Kuota trial kamu sudah habis.');
        }

        $sesi = Sesi::findOrFail($idsesi);

        DB::transaction(function () use ($user, $idsesi, $tanggal, $jam) {

        DB::table('user')
            ->where('userid', $user->userid)
            ->update([
                'kuotatrial' => $user->kuotatrial - 1
            ]);

        Pesanan::create([
            'idsesi'           => $idsesi,
            'userid'           => $user->userid,
            'tanggal'          => $tanggal,
            'jam'              => $jam,
            'biaya'            => 0,
            'istrial'          => true,
            'statuspembayaran' => 'free',
        ]);
    });

         return view ('Konfirmasi-Trial');
    }

    private function tentukanStatusTanggal($tanggal, $jam, $durasi = 50, $waktuSelesai = null)
    {
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
        $userId = session('user_id');

        $pesanan = DB::table('pesanan')
            ->where('idpesanan', $idpesanan)
            ->where('userid', $userId)
            ->first();

        if (!$pesanan) abort(404);

        return view('Sesi-Berlangsung', compact('pesanan'));
    }

    public function endCall($idpesanan)
    {
        DB::table('pesanan')
            ->where('idpesanan', $idpesanan)
            ->update([
                'waktu_selesai' => now()
            ]);

        return redirect()->route('aktivitas', ['tab' => 'lampau']);
    }


    public function aktivitas(Request $request)
    {
        $userId = session('user_id');

        $allowedTabs = ['akan-datang', 'berlangsung', 'lampau'];
        $tab = in_array($request->tab, $allowedTabs)
            ? $request->tab
            : 'akan-datang';

        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->where('pesanan.userid', $userId)
            ->select(
                'pesanan.idpesanan',
                'pesanan.tanggal',
                'pesanan.jam',
                'pesanan.statuspembayaran',
                'pesanan.waktu_selesai',
                'sesi.idsesi',
                'sesi.namaSesi',
                'sesi.harga',
                'sesi.filemateri',
                'sesi.rekamankelas',
                'tutor.nama as nama_tutor',
                'tutor.fototutor',
                'matakuliah.namamatkul'
            )
            ->get();

        $sesi = $pesanan->filter(function ($p) use ($tab) {
            $p->status_realtime = $this->tentukanStatusTanggal(
                $p->tanggal,
                $p->jam,
                50,
                $p->waktu_selesai
            );
            return $p->status_realtime === $tab;
        });

        if ($tab === 'akan-datang') {
            $sesi = $sesi->sortBy(function ($p) {
                return $p->tanggal . ' ' . $p->jam;
            });
        } elseif ($tab === 'lampau') {
            $sesi = $sesi->sortByDesc(function ($p) {
                return $p->tanggal . ' ' . $p->jam;
            });
        }

        return view('Aktivitas', [
            'sesi' => $sesi->values(),
            'tab'  => $tab
        ]);
    }

    public function detail($idpesanan)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid', $userId)
            ->select(
                'pesanan.idpesanan',
                'pesanan.tanggal as tanggal_pesanan',
                'pesanan.jam as jam_pesanan',
                'pesanan.biaya as biaya',
                'sesi.namaSesi',
                'sesi.harga',
                'sesi.filemateri',
                'sesi.rekamankelas',
                'sesi.deskripsi',
                'tutor.nama as nama_tutor',
                'tutor.fototutor',
                'matakuliah.namamatkul'
            )
            ->first();

        if (!$pesanan) {
            abort(404);
        }

        $statusRealtime = $this->tentukanStatusTanggal(
            $pesanan->tanggal_pesanan,
            $pesanan->jam_pesanan
        );

        return view('Detail-Aktivitas', compact('pesanan', 'statusRealtime'));
    }
}