<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Harya Raditya Handoyo - 5026231176
//Nailah Adlina - 5026231068
//Mirna Irawan - 5026221192

class UserController extends Controller
{
    public function home()
    {
        $user = DB::table('user')                      // ← fix: 'users' → 'user'
            ->where('userid', session('user_id'))      // ← fix: 'id' → 'userid'
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

        $tutor = DB::table('tutor')
            ->leftJoin('sesi',    'tutor.idtutor',    '=', 'sesi.idtutor')
            ->leftJoin('pesanan', 'sesi.idsesi',      '=', 'pesanan.idsesi')
            ->leftJoin('review',  'pesanan.idpesanan','=', 'review.idpesanan')
            ->select(
                'tutor.idtutor',
                'tutor.nama',
                'tutor.pekerjaan',
                'tutor.fototutor',
                DB::raw('COALESCE(AVG(review.rating), 0) as ratingtutor'),
                DB::raw('COUNT(review.idreview) as total_review')
            )
            ->groupBy('tutor.idtutor', 'tutor.nama', 'tutor.pekerjaan', 'tutor.fototutor')
            ->orderByDesc('ratingtutor')
            ->limit(6)
            ->get();

        return view('homepage', compact('user', 'kategori', 'tutor'));
    }

    public function index()
    {
        $userId = session('user_id');
        if (!$userId) return redirect('/login');

        $user = DB::table('user')                      // ← fix
            ->where('userid', $userId)                 // ← fix
            ->first();

        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) return redirect('/login');

        $request->validate([
            'fotoprofil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $dataUpdate = [];

        if ($request->hasFile('fotoprofil')) {
            $file     = $request->file('fotoprofil');
            $filename = 'profile_' . $userId . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profile', $filename, 'public');
            $dataUpdate['fotoprofil'] = 'storage/profile/' . $filename;
        }

        if (!empty($dataUpdate)) {
            DB::table('user')                          // ← fix
                ->where('userid', $userId)             // ← fix
                ->update($dataUpdate);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('q');

        $categories = DB::table('kategori')
            ->where('namakategori', 'LIKE', "%{$keyword}%")
            ->select('idkategori as id', 'namakategori as nama', DB::raw("'kategori' as tipe"))
            ->get();

        $matkul = DB::table('matakuliah')
            ->where('namamatkul', 'LIKE', "%{$keyword}%")
            ->select('idmatkul as id', 'namamatkul as nama', DB::raw("'matkul' as tipe"))
            ->get();

        $tutor = DB::table('tutor')
            ->where('nama', 'LIKE', "%{$keyword}%")
            ->select('idtutor as id', 'nama', DB::raw("'tutor' as tipe"))
            ->get();

        $sesi = DB::table('sesi')
            ->where('namaSesi', 'LIKE', "%{$keyword}%")
            ->select('idsesi as id', 'namaSesi as nama', DB::raw("'sesi' as tipe"))
            ->get();

        $results = collect()
            ->merge($categories)
            ->merge($matkul)
            ->merge($tutor)
            ->merge($sesi);

        return view('pencarian', compact('results', 'keyword'));
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
