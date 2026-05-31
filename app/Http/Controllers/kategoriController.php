<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Nailah Adlina (5026231068)

class kategoriController extends Controller
{
    public function kategori()
    {
        // Kodingan Asli Nembak Database
        $kategori = DB::table('kategori')->get();
        return view('Kategori', compact('kategori'));
    }
}