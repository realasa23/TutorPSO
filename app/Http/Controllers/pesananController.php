<?php

namespace App\Http\Controllers;
use App\Models\Sesi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Tambahan untuk fitur Auth/Login
use Carbon\Carbon;

// Nailah Adlina - 5026231068
// Mirna Irawan - 5026221192

class pesananController extends Controller
{
    public function storeRegular(Request $request)
    {
        // 1. Ambil data dari Session yang disimpan saat milih jadwal
        $tanggal = session('tanggal_pesanan');
        $jam     = session('jam_pesanan');
        $idsesi  = $request->idsesi ?? session('idsesi') ?? 1; 
        
        // PENGAMBILAN USER ID ASLI
        $userId = session('user_id') ?? Auth::id(); 
        if (!$userId) return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');

        // 2. Insert ke tabel pesanan di Supabase
        DB::table('pesanan')->insert([
            'idsesi'  => $idsesi,
            'userid'  => $userId, // Sudah menggunakan ID dinamis
            'tanggal' => $tanggal,
            'jam'     => $jam,
            'biaya'   => 50000, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Bersihkan memori agar pesanan selanjutnya tidak tertumpuk
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
            'userid'  => $userId, // Sudah menggunakan ID dinamis
            'tanggal' => $tanggal,
            'jam'     => $jam,
            'biaya'   => 0, // Harga 0 karena Trial
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

        // Ambil data asli dari database dengan cara menggabungkan (JOIN) tabel
        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->select('pesanan.*', 'sesi.namaSesi', 'tutor.nama as nama_tutor')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid', $userId) // Keamanan ekstra agar tidak bisa masuk ke sesi orang lain
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

        // Ambil SEMUA riwayat pesanan milik user yang sedang login
        $semuaPesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->select('pesanan.*', 'sesi.namaSesi', 'sesi.harga', 'tutor.nama as nama_tutor', 'tutor.fototutor', 'matakuliah.namamatkul')
            ->where('pesanan.userid', $userId) // Filter otomatis sesuai akun yang login
            ->orderBy('pesanan.tanggal', 'asc')
            ->get();

        $sesi = collect();

        // Filter data agar hanya muncul di Tab yang sesuai (Akan Datang / Berlangsung / Lampau)
        foreach ($semuaPesanan as $p) {
            $status_realtime = $this->tentukanStatusTanggal($p->tanggal, $p->jam, 50, null);
            
            if ($status_realtime == $tab) {
                $p->status_realtime = $status_realtime;
                $p->statuspembayaran = 'Lunas'; // Default UI display
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

        // Ambil data pesanan spesifik beserta detail tutor dan mata kuliah
        $pesanan = DB::table('pesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->select('pesanan.*', 'sesi.namaSesi', 'sesi.harga', 'tutor.nama as nama_tutor', 'tutor.fototutor', 'matakuliah.namamatkul')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid', $userId) // Keamanan agar tidak bisa melihat detail orang lain
            ->first();

        if (!$pesanan) {
            abort(404, 'Detail pesanan tidak ditemukan atau bukan milik Anda');
        }

        // Variabel tambahan untuk UI Blade
        $pesanan->filemateri = null;
        $pesanan->rekamankelas = null;
        $pesanan->deskripsi = 'Ini adalah deskripsi materi.';

        $pesanan->tanggal_pesanan = $pesanan->tanggal;
        $pesanan->jam_pesanan = $pesanan->jam;

        $statusRealtime = $this->tentukanStatusTanggal($pesanan->tanggal, $pesanan->jam, 50, null);

        return view('Detail-Aktivitas', compact('pesanan', 'statusRealtime'));
    }
}