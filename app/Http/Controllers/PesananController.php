<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// Nailah Adlina - 5026231068
// Mirna Irawan - 5026221192

class PesananController extends Controller
{
    private function sudahPesanSesiIni(int $userId, int $idsesi, string $tanggal, string $jam): bool
    {
        return DB::table('pesanan')
            ->where('userid',  $userId)
            ->where('idsesi',  $idsesi)
            ->where('tanggal', $tanggal)
            ->where('jam',     $jam)
            ->exists();
    }
 
    private function hitungBiaya(int $hargaPerJam, int $durasi): int
    {
        return $hargaPerJam * $durasi;
    }
 
    public function storeRegular(Request $request)
    {
        $tanggal = $request->tanggal ?? session('tanggal_pesanan');
        $jam     = $request->jam     ?? session('jam_pesanan');
        $durasi  = (int) ($request->durasi ?? session('durasi_pesanan', 1));
        $idsesi  = (int) ($request->idsesi ?? session('idsesi') ?? 1);
 
        $userId = session('user_id') ?? Auth::id();
        if (!$userId) return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
 
        // Cegah pesan dobel
        if ($this->sudahPesanSesiIni($userId, $idsesi, $tanggal, $jam)) {
            return back()->with('error', 'Kamu sudah memesan sesi ini pada tanggal dan jam yang sama.');
        }
 
        // Ambil harga dari tabel sesi
        $sesi = DB::table('sesi')->where('idsesi', $idsesi)->first();
        $biaya = $this->hitungBiaya($sesi->harga ?? 50000, $durasi);
 
        DB::table('pesanan')->insert([
            'idsesi'     => $idsesi,
            'userid'     => $userId,
            'tanggal'    => $tanggal,
            'jam'        => $jam,
            'durasi'     => $durasi,
            'biaya'      => $biaya,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
 
        session()->forget(['tanggal_pesanan', 'jam_pesanan', 'durasi_pesanan', 'idsesi']);
 
        return view('Konfirmasi-Pesanan');
    }
 
    public function storeTrial(Request $request)
    {
        $tanggal = $request->tanggal ?? session('tanggal_pesanan');
        $jam     = $request->jam     ?? session('jam_pesanan');
        $durasi  = (int) ($request->durasi ?? session('durasi_pesanan', 1));
        $idsesi  = (int) ($request->idsesi ?? session('idsesi') ?? 1);
 
        $userId = session('user_id') ?? Auth::id();
        if (!$userId) return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
 
        // Cegah trial dobel di sesi yang sama (1 user hanya boleh trial 1x per sesi)
        $sudahTrialSesiIni = DB::table('pesanan')
            ->where('userid', $userId)
            ->where('idsesi', $idsesi)
            ->where('biaya',  0)
            ->exists();
 
        if ($sudahTrialSesiIni) {
            return back()->with('error', 'Kamu sudah pernah mencoba trial untuk sesi ini.');
        }
 
        // Cegah pesan dobel tanggal+jam yang sama
        if ($this->sudahPesanSesiIni($userId, $idsesi, $tanggal, $jam)) {
            return back()->with('error', 'Kamu sudah memesan sesi ini pada tanggal dan jam yang sama.');
        }
 
        DB::table('pesanan')->insert([
            'idsesi'     => $idsesi,
            'userid'     => $userId,
            'tanggal'    => $tanggal,
            'jam'        => $jam,
            'durasi'     => $durasi,
            'biaya'      => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
 
        session()->forget(['tanggal_pesanan', 'jam_pesanan', 'durasi_pesanan', 'idsesi']);
 
        return view('Konfirmasi-Trial');
    }
 
    private function tentukanStatusTanggal(string $tanggal, string $jam, int $durasiMenit = 60): string
    {
        $jamMulai = trim(str_replace('.', ':', explode('-', $jam)[0]));
 
        try {
            $startAsli = Carbon::createFromFormat('Y-m-d H:i', "$tanggal $jamMulai");
        } catch (\Exception $e) {
            return 'lampau';
        }
 
        $start = $startAsli->copy()->subMinutes(5);
        $end   = $startAsli->copy()->addMinutes($durasiMenit);
        $now   = Carbon::now();
 
        if ($now->lt($start))             return 'akan-datang';
        if ($now->between($start, $end))  return 'berlangsung';
        return 'lampau';
    }
 
    public function gabungSesi($idpesanan)
    {
        $userId = session('user_id') ?? Auth::id();
        if (!$userId) return redirect('/login');
 
        $pesanan = DB::table('pesanan')
            ->join('sesi',  'pesanan.idsesi',  '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor',    '=', 'tutor.idtutor')
            ->select('pesanan.*', 'sesi.namaSesi', 'tutor.nama as nama_tutor')
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid',    $userId)
            ->first();
 
        if (!$pesanan) abort(404, 'Sesi tidak ditemukan atau bukan milik Anda');
 
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
 
        // Pakai groupBy di query untuk cegah duplikasi dari join
        $semuaPesanan = DB::table('pesanan')
            ->join('sesi',       'pesanan.idsesi',       '=', 'sesi.idsesi')
            ->join('tutor',      'sesi.idtutor',         '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul',        '=', 'matakuliah.idmatkul')
            ->select(
                'pesanan.idpesanan',
                'pesanan.idsesi',
                'pesanan.tanggal',
                'pesanan.jam',
                'pesanan.durasi',
                'pesanan.biaya',
                'pesanan.created_at',
                'sesi.namaSesi',
                'sesi.harga',
                'tutor.nama as nama_tutor',
                'tutor.fototutor',
                'matakuliah.namamatkul'
            )
            ->where('pesanan.userid', $userId)
            ->orderBy('pesanan.tanggal', 'asc')
            ->get();
 
        $sesi = collect();
 
        foreach ($semuaPesanan as $p) {
            $durasiMenit     = ($p->durasi ?? 1) * 60;
            $status_realtime = $this->tentukanStatusTanggal($p->tanggal, $p->jam, $durasiMenit);
 
            if ($status_realtime === $tab) {
                $p->status_realtime  = $status_realtime;
                $p->statuspembayaran = 'Lunas';
                $p->filemateri       = null;
                $p->rekamankelas     = null;
                $sesi->push($p);
            }
        }
 
        return view('Aktivitas', compact('sesi', 'tab'));
    }
 
    public function detail($idpesanan)
    {
        $userId = session('user_id') ?? Auth::id();
        if (!$userId) return redirect('/login');
 
        $pesanan = DB::table('pesanan')
            ->join('sesi',       'pesanan.idsesi',  '=', 'sesi.idsesi')
            ->join('tutor',      'sesi.idtutor',    '=', 'tutor.idtutor')
            ->join('matakuliah', 'sesi.idmatkul',   '=', 'matakuliah.idmatkul')
            ->select(
                'pesanan.*',
                'sesi.namaSesi',
                'sesi.harga',
                'tutor.nama as nama_tutor',
                'tutor.fototutor',
                'matakuliah.namamatkul'
            )
            ->where('pesanan.idpesanan', $idpesanan)
            ->where('pesanan.userid',    $userId)
            ->first();
 
        if (!$pesanan) abort(404, 'Detail pesanan tidak ditemukan atau bukan milik Anda');
 
        $pesanan->filemateri     = null;
        $pesanan->rekamankelas   = null;
        $pesanan->deskripsi      = 'Ini adalah deskripsi materi.';
        $pesanan->tanggal_pesanan = $pesanan->tanggal;
        $pesanan->jam_pesanan    = $pesanan->jam;
 
        $durasiMenit  = ($pesanan->durasi ?? 1) * 60;
        $statusRealtime = $this->tentukanStatusTanggal($pesanan->tanggal, $pesanan->jam, $durasiMenit);
 
        return view('Detail-Aktivitas', compact('pesanan', 'statusRealtime'));
    }
}