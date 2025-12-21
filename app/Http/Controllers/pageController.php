<?php

/* =======================
    Nama: Harya Raditya Handoyo
    NRP: 5026231176
======================= */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Halaman Home
    public function index()
    {
        return view('homepage');
    }

    // Halaman Pencarian
    public function search()
    {
        return view('pencarian');
    }

    // Halaman Kategori (Harus sesuai casing: KATEGORI.blade.php)
    public function category()
    {
        return view('KATEGORI');
    }

    // Halaman List Tutor
    public function listTutor()
    {
        return view('listutor');
    }

    // Halaman Chat (Harus sesuai casing: Chat.blade.php)
    public function chat()
    {
        return view('Chat');
    }

    // Halaman Profile (Harus sesuai casing: Profile.blade.php)
    public function profile()
    {
        return view('Profile');
    }
}
