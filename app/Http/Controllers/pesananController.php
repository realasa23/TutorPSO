<?php

namespace App\Http\Controllers;
use App\Models\Sesi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

//Nailah Adlina - 5026231068
class pesananController extends Controller
{
    public function akanDatang()
    {
       return view('Aktivitas-AkanDatang');
    }   
    public function berlangsung()
    {
       return view('Aktivitas-Berlangsung');
    }

    public function lampau()
    {
       return view('Aktivitas-Lampau');
    }

    public function gabungSesi(){
        return view ('Sesi-Berlangsung');
    }

    public function endCall(){
        return view ('Sesi-Selesai');
    }

     public function storeRegular(Request $request)
    {
        // Ambil data dari session (dari step pilih tanggal & jam)
        $idsesi   = session('idsesi');
        $tanggal  = session('tanggal_pesanan');
        $jam      = session('jam_pesanan');

        // Ambil user dari session login manual
        $userId = session('user_id');

        if (!$idsesi || !$tanggal || !$jam) {
            return redirect()->back()->with('error', 'Data pesanan tidak lengkap. Silakan ulangi pemesanan.');
        }

        $user = DB::table('user')->where('userid', $userId)->first();
        // Pastikan sesi ada
        $sesi = Sesi::findOrFail($idsesi);

        // Hitung status berdasarkan tanggal
        $status = $this->tentukanStatusTanggal($tanggal);

        // Simpan ke tabel pesanan
        Pesanan::create([
            'idsesi'           => $idsesi,
            'userid'           => $user->userid,  // atau $user->user_id kalau di db pakai itu
            'tanggal'          => $tanggal,
            'jam'              => $jam,
            'istrial'          => false,
            'statuspembayaran' => 'berhasil',
            'status'           => $status,
        ]);

        return redirect('/aktivitas/detail-akan-datang')
            ->with('success', 'Pesanan sesi berhasil dibuat.');
    }

    /**
     * Simpan pesanan trial
     */
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

        // Cek kuota trial user
        if ($user->kuotatrial <= 0) {
            return redirect()->back()->with('error', 'Kuota trial kamu sudah habis.');
        }

        $sesi = Sesi::findOrFail($idsesi);
        $status = $this->tentukanStatusTanggal($tanggal);

        DB::transaction(function () use ($user, $idsesi, $tanggal, $jam, $status) {
            // Kurangi kuota trial user
            DB::table('user')
            ->where('userid', $userId)
            ->update(['kuotatrial' => $user->kuotatrial - 1]);


            // Simpan pesanan trial
            Pesanan::create([
                'idsesi'           => $idsesi,
                'userid'           => $user->id,
                'tanggal'          => $tanggal,
                'jam'              => $jam,
                'istrial'          => true,
                'statuspembayaran' => 'free',
                'status'           => $status,
            ]);
        });

         return redirect('/aktivitas/detail-akan-datang')
            ->with('success', 'Pesanan trial berhasil dibuat. Kuota trial berkurang 1.');
    }

    //Fungsi helper untuk menentukan status berdasarkan tanggal
    protected function tentukanStatusTanggal($tanggal)
    {
        $tanggalSesi = Carbon::parse($tanggal)->startOfDay();
        $hariIni     = Carbon::today();

        if ($tanggalSesi->lt($hariIni)) {
            return 'lampau';
        }

        if ($tanggalSesi->eq($hariIni)) {
            return 'berlangsung';
        }

        return 'akan datang';
    }

}
