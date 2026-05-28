<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

//Nailah Adlina (5026231068)

class kategoriController extends Controller
{
    public function kategori()
    {
        // --- BYPASS SEMENTARA: DUMMY DATA KATEGORI ---
        $kategori = collect([
            (object)[
                'idkategori' => 1,
                'namakategori' => 'Pemrograman Web',
                'total_materi' => 15
            ],
            (object)[
                'idkategori' => 2,
                'namakategori' => 'Database & Graph (Neo4j)',
                'total_materi' => 8
            ],
            (object)[
                'idkategori' => 3,
                'namakategori' => 'Desain UI/UX',
                'total_materi' => 12
            ],
            (object)[
                'idkategori' => 4,
                'namakategori' => 'Keamanan Siber (Ethical Hacking)',
                'total_materi' => 5
            ]
        ]);

        return view('Kategori', compact('kategori'));
    }
}