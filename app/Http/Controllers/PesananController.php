<?php

namespace App\Http\Controllers;
use App\Models\Sesi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// Nailah Adlina - 5026231068
// Mirna Irawan - 5026221192

class PesananController extends Controller
{
    public function storeRegular(Request $request)
    {
        $tanggal = session('tanggal_pesanan');
        $jam     = session('jam_pesanan');
        $idsesi  = $request->idsesi ?? session('idsesi') ?? 1; 
        
        $userId = session('user_id') ?? Auth::id(); 
        if (!$userId) return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');

        DB::table('pesanan')->insert([
            'idsesi'  => $idsesi,
            'userid'  => $userId,
            'tanggal' => $tanggal,
            'jam'     => $jam,
            'biaya'   => 50000, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->forget(['tanggal_pesanan', 'jam_pesanan', 'idsesi']);

        return view('Konfirmasi-Pesanan');
    }

    public function storeTrial(Request $request)
    {
        $tanggal = session('tanggal_pesanan');
        $jam     = session('jam_pesanan');
        $idsesi  = $request->idsesi ?? session('idsesi') ?? 1;

        $userId = session('user_id') ?? Auth::id(); 
        if (!$userId) return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');

        DB::table('pesanan')->insert([
            'idsesi'  => $idsesi,
            'userid'  => $userId,
            'tanggal' => $tanggal,
            'jam'     => $jam,
            'biaya'   => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->forget(['tanggal_pesanan', 'jam_pesanan', 'idsesi']);

        return view('Konfirmasi-Trial');
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
        $userId = session('user_id') ?? Auth::id(); 
        if (!$userId) return redirect('/login');

        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->select('pesanan.*', 'sesi.namaSesi', 'tutor.nama as nama_tutor')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid', $userId)
            ->first();

        if (!$pesanan) {
            abort(404, 'Sesi tidak ditemukan atau bukan milik Anda');
        }

        return view('Sesi-Berlangsung', compact('pesanan'));
    }

    public function endCall($idpesanan)
    {   
        return redirect()->route('aktivitas', ['tab' => 'lampau']);
    }

    public function aktivitas(Request $request)
    {
        $allowedTabs = ['akan-datang', 'berlangsung', 'lampau'];
        $tab = in_array($request->tab, $allowedTabs) ? $request->tab : 'akan-datang';

        $userId = session('user_id') ?? Auth::id(); 
        if (!$userId) return redirect('/login');

        $semuaPesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->select('pesanan.*', 'sesi.namaSesi', 'sesi.harga', 'tutor.nama as nama_tutor', 'tutor.fototutor', 'matakuliah.namamatkul')
            ->where('pesanan.userid', $userId)
            ->orderBy('pesanan.tanggal', 'asc')
            ->get();

        $sesi = collect();

        foreach ($semuaPesanan as $p) {
            $status_realtime = $this->tentukanStatusTanggal($p->tanggal, $p->jam, 50, null);
            
            if ($status_realtime == $tab) {
                $p->status_realtime = $status_realtime;
                $p->statuspembayaran = 'Lunas';
                $p->filemateri = null;
                $p->rekamankelas = null;
                
                $sesi->push($p);
            }
        }

        return view('Aktivitas', [
            'sesi' => $sesi,
            'tab'  => $tab
        ]);
    }

    public function detail($idpesanan)
    {
        $userId = session('user_id') ?? Auth::id(); 
        if (!$userId) return redirect('/login');

        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->select('pesanan.*', 'sesi.namaSesi', 'sesi.harga', 'tutor.nama as nama_tutor', 'tutor.fototutor', 'matakuliah.namamatkul')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid', $userId)
            ->first();

        if (!$pesanan) {
            abort(404, 'Detail pesanan tidak ditemukan atau bukan milik Anda');
        }

        $pesanan->filemateri = null;
        $pesanan->rekamankelas = null;
        $pesanan->deskripsi = 'Ini adalah deskripsi materi.';
        $pesanan->tanggal_pesanan = $pesanan->tanggal;
        $pesanan->jam_pesanan = $pesanan->jam;

        $statusRealtime = $this->tentukanStatusTanggal($pesanan->tanggal, $pesanan->jam, 50, null);

        return view('Detail-Aktivitas', compact('pesanan', 'statusRealtime'));
    }
}