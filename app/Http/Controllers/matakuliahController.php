<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

// Nailah Adlina - 5026231068

class matakuliahController extends Controller
{
    public function materi($idkategori)
    {
        // --- BYPASS SEMENTARA ---
        $kategori = (object) ['idkategori' => $idkategori, 'namakategori' => 'Kategori Dummy'];
        
        // Kasih dummy matkul biar UI nggak kosong
        $matakuliah = collect([
            (object)['idmatkul' => 1, 'namamatkul' => 'Matkul Dummy 1', 'jumlah_sesi' => 3],
            (object)['idmatkul' => 2, 'namamatkul' => 'Matkul Dummy 2', 'jumlah_sesi' => 5]
        ]);

        return view('List-Materi', compact('kategori', 'matakuliah'));
    }
}