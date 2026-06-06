<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//Michelle Lea Amanda - 5026231214
//Nailah Adlina - 5026231068

class RefundController extends Controller
{
    public function processRefund()
    {
        $userId = session('user_id') ?? Auth::id();
        if (!$userId) {
            return redirect('/login');
        }

        $laporan = DB::table('laporanmasalah')
            ->join('pesanan', function ($join) {
                $join->on('laporanmasalah.idsesi', '=', 'pesanan.idsesi')
                     ->on('laporanmasalah.userid', '=', 'pesanan.userid');
            })
            ->join('sesi', 'laporanmasalah.idsesi', '=', 'sesi.idsesi')
            ->join('tutor', 'sesi.idtutor', '=', 'tutor.idtutor')
            ->leftJoin('refund', 'laporanmasalah.idlaporan', '=', 'refund.idlaporan')
            ->where('laporanmasalah.userid', $userId)
            ->select(
                'laporanmasalah.idlaporan',
                'laporanmasalah.kategorimasalah',
                'laporanmasalah.statuslaporan',
                'tutor.nama as nama_tutor',
                'tutor.fototutor',
                'sesi.namaSesi as namasesi', 
                'pesanan.tanggal',
                'pesanan.jam',
                'refund.statusrefund',
                'refund.jumlahpengembalian'
            )
            ->distinct() 
            ->orderBy('laporanmasalah.idlaporan', 'desc')
            ->get();

        foreach ($laporan as $item) {
            if ($item->jam) {
                $item->jam = str_replace([' ', ':'], ['', '.'], $item->jam);
            }
        }

        return view('History-Laporan', compact('laporan'));
    }

    public function refundSelesai($idlaporan)
    {
        $userId = session('user_id') ?? Auth::id();
        if (!$userId) {
            return redirect('/login');
        }

        $data = DB::table('laporanmasalah')
            ->join('pesanan', function ($join) {
                $join->on('laporanmasalah.idsesi', '=', 'pesanan.idsesi')
                     ->on('laporanmasalah.userid', '=', 'pesanan.userid');
            })
            ->leftJoin('refund', 'refund.idlaporan', '=', 'laporanmasalah.idlaporan')
            ->where('laporanmasalah.idlaporan', $idlaporan)
            ->where('laporanmasalah.userid', $userId)
            ->select(
                'laporanmasalah.idlaporan',
                'refund.idrefund',
                'refund.statusrefund',
                'pesanan.biaya as harga_sesi'
            )
            ->first();

        if (!$data) {
            abort(404);
        }

        if ($data->idrefund && $data->statusrefund !== 'Berhasil') {
            DB::table('refund')
                ->where('idrefund', $data->idrefund)
                ->update([
                    'statusrefund' => 'Berhasil',
                    'updated_at'   => now()
                ]);
        }

        return view('Refund-Berhasil', [
            'harga' => $data->harga_sesi
        ]);
    }
}