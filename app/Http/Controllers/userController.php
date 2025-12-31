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
        $user = DB::table('users')
            ->where('userid', session('user_id'))
            ->first();

        $kategori = DB::table('kategori')
            ->leftJoin('matakuliah', 'kategori.idkategori', '=', 'matakuliah.idkategori')
            ->select(
                'kategori.idkategori',
                'kategori.namakategori',
                DB::raw('COUNT(matakuliah.idmatkul) as total_materi')
            )
            ->groupBy('kategori.idkategori', 'kategori.namakategori')
            ->get();

        $tutor = DB::table('tutor as t')
            ->leftJoin('sesi as s', 's.idtutor', '=', 't.idtutor')
            ->leftJoin('pesanan as p', 'p.idsesi', '=', 's.idsesi')
            ->leftJoin('review as r', 'r.idpesanan', '=', 'p.idpesanan')
            ->select(
                't.idtutor',
                't.nama',
                't.pekerjaan',
                't.fototutor',
                DB::raw('COALESCE(AVG(r.rating),0) as ratingtutor'),
                DB::raw('COUNT(DISTINCT r.idreview) as total_review')
            )
            ->groupBy(
                't.idtutor',
                't.nama',
                't.pekerjaan',
                't.fototutor'
            )
            ->orderByDesc('ratingtutor')
            ->orderByDesc('total_review')
            ->limit(6)
            ->get();

        return view('Homepage', compact('user', 'kategori', 'tutor'));
    }


    public function index()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $user = DB::table('users')->where('userid', $userId)->first();
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
            'username' => $request->username,
            'email'    => $request->email,
            'nomorhp'  => $request->nomorhp
        ];

        if ($request->hasFile('fotoprofil')) {
            $file = $request->file('fotoprofil');
            $filename = 'profile_' . $userId . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile', $filename, 'public');

            $dataUpdate['fotoprofil'] = 'storage/' . $path;
        }

        DB::table('users')
            ->where('userid', $userId)
            ->update($dataUpdate);

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('q');
        $categories = DB::table('kategori')
            ->when($keyword, fn ($q) =>
                $q->where('namakategori', 'LIKE', "%{$keyword}%")
            )
            ->select(
                'idkategori as id',
                'namakategori as title'
            )
            ->get()
            ->map(function ($item) {
                $item->type = 'Kategori';
                $item->subtitle = 'Kategori';
                $item->icon = 'bi-grid';
                $item->theme = 'orange';
                return $item;
            });

        $matkul = DB::table('matakuliah')
            ->when($keyword, fn ($q) =>
                $q->where('namamatkul', 'LIKE', "%{$keyword}%")
            )
            ->select(
                'idmatkul as id',
                'namamatkul as title'
            )
            ->get()
            ->map(function ($item) {
                $item->type = 'Mata Kuliah';
                $item->subtitle = 'Mata Kuliah';
                $item->icon = 'bi-book';
                $item->theme = 'indigo';
                return $item;
            });

        $tutor = DB::table('tutor')
            ->when($keyword, fn ($q) =>
                $q->where('nama', 'LIKE', "%{$keyword}%")
            )
            ->select(
                'idtutor as id',
                'nama as title'
            )
            ->get()
            ->map(function ($item) {
                $item->type = 'Tutor';
                $item->subtitle = 'Tutor';
                $item->icon = 'bi-person';
                $item->theme = 'pink';
                return $item;
            });

        $sesi = DB::table('sesi')
            ->when($keyword, fn ($q) =>
                $q->where('namaSesi', 'LIKE', "%{$keyword}%")
            )
            ->select(
                'idsesi as id',
                'namaSesi as title'
            )
            ->get()
            ->map(function ($item) {
                $item->type = 'Sesi';
                $item->subtitle = 'Sesi Tutor';
                $item->icon = 'bi-calendar-event';
                $item->theme = 'indigo';
                return $item;
            });

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