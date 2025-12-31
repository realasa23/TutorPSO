<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//Peter Christian Erastus - 5026231138

class logincontroller extends Controller
{
    public function index()
	{
		return view('Landing-Page');

	}

    public function login()
	{
		return view('Login');

	}

    public function register()
	{
		return view('Register');

	}

    public function handleLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $users = DB::table('users')->where('email', $validated['email'])->first();

        if ($users && Hash::check($validated['password'], $users->password)) {
            session(['user_id' => $users->userid,'user_email' => $users->email]);
            return redirect('/home')->with('success', 'Login successful');  
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function handleRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|string'
        ]);

        $exists = DB::table('users')->where('email', $validated['email'])->exists();

        if ($exists) {
            return back()->withErrors(['email' => 'Email already registered'])->withInput();
        }

        DB::table('users')->insert([
            'username' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'nomorhp' => $validated['phone']
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }
}