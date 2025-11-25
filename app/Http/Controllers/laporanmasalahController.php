<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laporanmasalah;
use App\Models\Refund;
use App\Models\user; 
use Illuminate\Support\Facades\DB;

class laporanmasalahController extends Controller
{
    public function pageLaporan()
    {
        return view('Aktivitas-Lampau-Laporkan'); 
    }

    public function detailMasalah(Request $request)
    {
        $jenisMasalah = $request->query('jenis', 'Masalah Umum');

        return view('Aktivitas-Lampau-Detail-Masalah', compact('jenisMasalah'));
    }

    public function konfirmasiMasalah(Request $request)
    {
        return view('Aktivitas-Lampau-Konfirmasi'); 
    }

    public function prosesRefund(Request $request)
    {
        $request->validate([
            'pesanan_id'    => 'required', 
            'jenis_masalah' => 'required',
            'deskripsi'     => 'required',
        ]);

        $lastData = laporanmasalah::orderBy('idlaporan', 'desc')->first();
        $number = $lastData ? intval(substr($lastData->idlaporan, 1)) + 1 : 1;
        $newId = 'L' . str_pad($number, 2, '0', STR_PAD_LEFT);
        
        $userId = 1;
        if (!DB::table('user')->where('userid', $userId)->exists()) {
            DB::table('user')->insert([
                'userid' => $userId, 'username' => 'User Dummy', 'email' => 'dummy@example.com', 'password' => '123', 'nomorhp' => '08123456789'
            ]);
        }

        $sesiId = $request->pesanan_id; // ID dari form (valuenya 1)
        
        if (!DB::table('sesi')->where('idsesi', $sesiId)->exists()) {
            
            if (!DB::table('kategori')->where('idkategori', 1)->exists()) {
                DB::table('kategori')->insert(['idkategori' => 1, 'namakategori' => 'IT']);
            }

            if (!DB::table('matakuliah')->where('idmatkul', 1)->exists()) {
                DB::table('matakuliah')->insert([
                    'idmatkul' => 1, 'idkategori' => 1, 'namamatkul' => 'Pemrograman Dasar'
                ]);
            }

            if (!DB::table('tutor')->where('idtutor', 1)->exists()) {
                DB::table('tutor')->insert([
                    'idtutor' => 1, 'nama' => 'Tutor Dummy', 'pekerjaan' => 'Dosen', 'deskripsi' => '-', 'ratingtutor' => 5
                ]);
            }

            DB::table('sesi')->insert([
                'idsesi' => $sesiId,
                'idmatkul' => 1,
                'idtutor' => 1,
                'harga' => 50000,
                'tanggal' => now(),
                'jam' => now(),
                'filemateri' => '-',
                'zoomtutor' => '-',
                'rekamankelas' => '-'
            ]);
        }

        laporanmasalah::create([
            'idlaporan'        => $newId, 
            'userid'           => $userId,
            'idsesi'           => $sesiId,
            'kategorimasalah'  => $request->jenis_masalah,
            'deskripsimasalah' => $request->deskripsi,
            'statuslaporan'    => 'Pending',
        ]);


        $kategoriRefund = ['Tutor Tidak Hadir', 'Kesalahan Jadwal'];

        if (in_array($request->jenis_masalah, $kategoriRefund)) {
            
            $lastRefund = \App\Models\Refund::orderBy('idrefund', 'desc')->first();
            $numRef = $lastRefund ? intval(substr($lastRefund->idrefund, 1)) + 1 : 1;
            $newRefundId = 'R' . str_pad($numRef, 2, '0', STR_PAD_LEFT);

            \App\Models\Refund::create([
                'idrefund'           => $newRefundId, 
                'idlaporan'          => $newId,
                'statusrefund'       => 'Diproses',
                'jumlahpengembalian' => 50000
            ]);
            
            return redirect()->route('refund.sukses');
        }
        return redirect()->route('laporan.sukses');
    }
    public function laporanSukses() { return view('Aktivitas-Lampau-Pilih masalah-Laporan Berhasil'); }
}