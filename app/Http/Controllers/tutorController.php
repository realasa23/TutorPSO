<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesi;
use App\Models\Tutor;
use App\Models\Matakuliah;

class tutorController extends Controller
{
    public function listTutor()
    {
       
      $sesis = Sesi::with(['tutor', 'matakuliah'])->get();

        // Kirim data sesis ke view list-tutor
        // Pastikan nama file view Anda adalah 'list-tutor.blade.php'
        return view('List-SesiTutor', [
            'sesis' => $sesis
        ]);
    }
}
