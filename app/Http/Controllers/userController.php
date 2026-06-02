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
        // Ambil data user yang lagi login
        $user = DB::table('users')
            ->where('id', session('user_id'))
            ->first();

        // --- BYPASS SEMENTARA: DUMMY DATA UNTUK HOME ---
        
        // 1. Dummy Kategori
        $kategori = collect([
            (object)[
                'idkategori' => 1,
                'namakategori' => 'Matematika & IPA',
                'total_materi' => 5
            ],
            (object)[
                'idkategori' => 2,
                'namakategori' => 'Bahasa & Sastra',
                'total_materi' => 3
            ],
            (object)[
                'idkategori' => 3,
                'namakategori' => 'Ilmu Sosial',
                'total_materi' => 2
            ],
        ]);

        // 2. Dummy Tutor (Top 6)
        $tutor = collect([
            (object)[
                'idtutor' => 1,
                'nama' => 'Dr. Budi Santoso',
                'pekerjaan' => 'Dosen Matematika',
                'fototutor' => 'https://ui-avatars.com/api/?name=Budi+Santoso',
                'ratingtutor' => 4.9,
                'total_review' => 125
            ],
            (object)[
                'idtutor' => 2,
                'nama' => 'Siti Nuraini, M.Pd.',
                'pekerjaan' => 'Guru Bahasa Inggris',
                'fototutor' => 'https://ui-avatars.com/api/?name=Siti+Nuraini',
                'ratingtutor' => 4.8,
                'total_review' => 98
            ],
            (object)[
                'idtutor' => 3,
                'nama' => 'Andi Pratama',
                'pekerjaan' => 'Ahli Sejarah',
                'fototutor' => 'https://ui-avatars.com/api/?name=Andi+Pratama',
                'ratingtutor' => 4.7,
                'total_review' => 85
            ],
        ]);

        // Kirim data dummy ke view Homepage
        return view('homepage', compact('user', 'kategori', 'tutor'));
    }


    public function index()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        // 'user' jadi 'users', 'userid' jadi 'id'
        $user = DB::table('users')->where('id', $userId)->first();
        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $request->validate([
            'fotoprofil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $dataUpdate = [];

        if ($request->hasFile('fotoprofil')) {
            $file     = $request->file('fotoprofil');
            $filename = 'profile_' . $userId . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/profile/
            $file->storeAs('profile', $filename, 'public');

            // Path yang disimpan ke DB, diakses via asset('storage/profile/xxx.jpg')
            $dataUpdate['fotoprofil'] = 'storage/profile/' . $filename;
        }

        if (!empty($dataUpdate)) {
            DB::table('users')
                ->where('id', $userId)
                ->update($dataUpdate);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui');
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