<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pesananController extends Controller
{
    public function index()
    {
       return view('Aktivitas-AkanDatang');
    }

    public function berlangsung()
    {
       return view('Aktivitas-Berlangsung');
    }

    public function lampau()
    {
       return view('Aktivitas-Lampau');
    }

    public function gabungSesi(){
        return view ('Sesi-Berlangsung');
    }

    public function endCall(){
        return view ('Sesi-Selesai');
    }

    public function berhasilPesan(){
        return view ('Konfirmasi-Pesanan');
    }

    public function berhasilTrial(){
        return view ('Konfirmasi-Trial');
    }
}
