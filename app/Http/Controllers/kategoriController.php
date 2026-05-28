<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Nailah Adlina (5026231068)

class kategoriController extends Controller
{
    public function kategori()
    {
        // --- BYPASS SEMENTARA ---
        // Karena tabel 'kategori' dan 'matakuliah' belum ada di database,
        // kita kirim array kosong supaya halaman Kategori.blade.php nggak crash.
        $kategori = collect([]);

        return view('Kategori', compact('kategori'));
    }
}