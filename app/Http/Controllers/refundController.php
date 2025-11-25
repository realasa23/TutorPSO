<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class refundController extends Controller
{
    /**
     * Menampilkan Halaman Sukses Refund (Puzzle)
     * Fungsi ini dipanggil saat route 'refund.sukses' diakses
     */
    public function refundSukses()
    {
        // Pastikan nama file view ini SAMA PERSIS dengan file blade Anda
        return view('Aktivitas-Lampau-Pilih masalah-Pengajuan Refund Berhasil');
    }
}