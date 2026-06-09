<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('Landing-Page');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function handleLogin(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('user')->where('email', $validated['email'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            session(['user_id' => $user->userid, 'user_email' => $user->email]);
            return redirect('/home')->with('success', 'Login successful');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function handleRegister(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|unique:user',
            'password' => 'required|min:6|confirmed',
            'nomorhp'  => 'required|string|max:15',
        ]);

        $exists = DB::table('user')->where('email', $validated['email'])->exists();

        if ($exists) {
            return back()->withErrors(['email' => 'Email already registered'])->withInput();
        }

        DB::table('user')->insert([
            'username'   => $validated['username'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
            'nomorhp'    => $validated['nomorhp'],
            'kuotatrial' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }
}