<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Harya Raditya Handoyo - 5026231176
// Nailah Adlina - 5026231068

class tutorController extends Controller
{
    public function recTutor()
    {
        // Kodingan Asli Nembak Database
        $tutor = DB::table('tutor')->get();
        return view('List-Tutor', compact('tutor'));
    }

    // ... (Fungsi profile dan listSesi biarin pakai kodingan asli lu sebelumnya)
}