<?php
namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Harya Raditya Handoyo - 5026231176
//Nailah Adlina - 5026231068
//Mirna Irawan - 5026221192

class UserController extends Controller
{
    public function home()
    {
        // REVISI: 'user' jadi 'users', 'userid' jadi 'id'
        $user = DB::table('users')
            ->where('id', session('user_id'))
            ->first();

        // --- BYPASS SEMENTARA ---
        // Karena tabel belum ada di database, kita kirim array kosong 
        // supaya halaman Homepage.blade.php nggak crash pas di-load.
        $kategori = collect([]);
        $tutor = collect([]);

        return view('Homepage', compact('user', 'kategori', 'tutor'));
    }


    public function index()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        // REVISI: 'user' jadi 'users', 'userid' jadi 'id'
        $user = DB::table('users')->where('id', $userId)->first();
        return view('Profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $request->validate([
            'username'   => 'required|string|max:100',
            'email'      => 'required|email|max:150',
            'nomorhp'    => 'nullable|string|max:20',
            'fotoprofil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $dataUpdate = [
            'name' => $request->username, // REVISI: disesuaikan dengan kolom di DB yaitu 'name'
            'email'    => $request->email,
            // 'nomorhp'  => $request->nomorhp // REVISI: di-comment karena kolom belum ada di DB
        ];

        if ($request->hasFile('fotoprofil')) {
            $file = $request->file('fotoprofil');
            $filename = 'profile_' . $userId . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile', $filename, 'public');

            $dataUpdate['fotoprofil'] = 'storage/' . $path;
        }

        // REVISI: 'user' jadi 'users', 'userid' jadi 'id'
        DB::table('users')
            ->where('id', $userId)
            ->update($dataUpdate);

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('q');
        
        // --- BYPASS SEMENTARA JUGA ---
        // Biar pas fitur search dicoba nggak muncul error tabel missing.
        $categories = collect([]);
        $matkul = collect([]);
        $tutor = collect([]);
        $sesi = collect([]);

        $results = collect()
            ->merge($categories)
            ->merge($matkul)
            ->merge($tutor)
            ->merge($sesi);

        return view('Pencarian', compact('results', 'keyword'));
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}