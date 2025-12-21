<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class logincontroller extends Controller
{
    // Menampilkan Halaman Awal
    public function index()
    {
        return view('page_awal');
    }

    // Menampilkan Form Login
    public function login()
    {
        return view('login');
    }

    // Menampilkan Form Register
    public function register()
    {
        return view('register');
    }

    // PROSES LOGIN
    public function handleLogin(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Cari user berdasarkan email
        $user = DB::table('user')->where('email', $request->email)->first();

        // 3. Cek password
        if ($user && Hash::check($request->password, $user->password)) {

            // Simpan data user ke session (Sesuai kolom di DB kamu: userid, email, username)
            session([
                'user_id' => $user->userid,    // Sesuai screenshot: userid
                'user_email' => $user->email,  // Sesuai screenshot: email
                'user_name' => $user->username // Sesuai screenshot: username
            ]);

            // Redirect ke Homepage
            return redirect()->route('home')->with('success', 'Berhasil Login!');
        }

        // Kalau gagal login
        return back()->withErrors(['email' => 'Email atau Password salah!'])->withInput();
    }

    // PROSES REGISTER
    public function handleRegister(Request $request)
    {
        // 1. Validasi Input dari Form
        $validated = $request->validate([
            'name' => 'required|string|max:255',     // Asumsi di form namanya 'name'
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|string'             // Asumsi di form namanya 'phone'
        ]);

        // 2. Masukkan data ke Database (Sesuai kolom DB kamu)
        DB::table('user')->insert([
            'username' => $validated['name'],       // Masuk ke kolom 'username'
            'email' => $validated['email'],         // Masuk ke kolom 'email'
            'password' => Hash::make($validated['password']),
            'nomorhp' => $validated['phone'],       // Masuk ke kolom 'nomorhp'
            'kuotatrial' => 3                       // Default kuota trial (sesuai screenshot)
        ]);

        // 3. Auto Login setelah register
        $user = DB::table('user')->where('email', $validated['email'])->first();

        session([
            'user_id' => $user->userid,
            'user_email' => $user->email,
            'user_name' => $user->username
        ]);

        // Redirect ke Homepage
        return redirect()->route('home')->with('success', 'Akun berhasil dibuat!');
    }

    // LOGOUT
    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Berhasil Logout');
    }
}