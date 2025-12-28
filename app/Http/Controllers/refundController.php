<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Michelle Lea Amanda (5026231214)
//Nailah Adlina (5026231068)

class refundController extends Controller
{
    public function processRefund()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $laporan = DB::table('laporanmasalah')
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
                'sesi.namasesi',
                'sesi.tanggal',
                'sesi.jam',
                'refund.statusrefund',
                'refund.jumlahpengembalian'
            )
            ->orderBy('laporanmasalah.idlaporan', 'desc')
            ->get();

        return view('History-Laporan', compact('laporan'));
    }

    public function refundSelesai($idlaporan)
    {
        $userId = session('user_id');

        $data = DB::table('laporanmasalah')
            ->join('sesi', 'laporanmasalah.idsesi', '=', 'sesi.idsesi')
            ->leftJoin('refund', 'refund.idlaporan', '=', 'laporanmasalah.idlaporan')
            ->where('laporanmasalah.idlaporan', $idlaporan)
            ->where('laporanmasalah.userid', $userId)
            ->select(
                'laporanmasalah.idlaporan',
                'refund.idrefund',
                'refund.statusrefund',
                'sesi.harga as harga_sesi'
            )
            ->first();

        if (!$data) {
            abort(404);
        }

        if ($data->idrefund && $data->statusrefund !== 'Berhasil') {
            DB::table('refund')
                ->where('idrefund', $data->idrefund)
                ->update([
                    'statusrefund' => 'Berhasil'
                ]);
        }

        return view('Refund-Berhasil', [
            'harga' => $data->harga_sesi
        ]);
    }
}