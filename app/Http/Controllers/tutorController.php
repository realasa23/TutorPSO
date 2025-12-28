<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sesi;
use App\Models\Tutor;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

//
//Nailah Adlina (5026231068)

class tutorController extends Controller
{
    public function recTutor()
    {
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
            ->limit(10)
            ->get();

        return view('List-Tutor', compact('tutor'));
    }

    public function profile($id)
    {
        $tutor = DB::table('tutor as t')
            ->leftJoin('sesi as s', 's.idtutor', '=', 't.idtutor')
            ->leftJoin('pesanan as p', 'p.idsesi', '=', 's.idsesi')
            ->leftJoin('review as r', 'r.idpesanan', '=', 'p.idpesanan')
            ->where('t.idtutor', $id)
            ->select(
                't.idtutor',
                't.nama',
                't.pekerjaan',
                't.deskripsi',
                't.fototutor',
                DB::raw('COALESCE(AVG(r.rating), 0) as ratingtutor'),
                DB::raw('COUNT(DISTINCT r.idreview) as total_review')
            )
            ->groupBy(
                't.idtutor',
                't.nama',
                't.pekerjaan',
                't.deskripsi',
                't.fototutor'
            )
            ->first();

        if (!$tutor) abort(404);

        $reviews = DB::table('review as r')
            ->join('pesanan as p', 'p.idpesanan', '=', 'r.idpesanan')
            ->join('users as u', 'u.userid', '=', 'p.userid')
            ->join('sesi as s', 's.idsesi', '=', 'p.idsesi')
            ->where('s.idtutor', $id)
            ->select(
                'u.username',
                'r.rating',
                'r.komentar',
                'r.tanggalreview'
            )
            ->orderByDesc('r.tanggalreview')
            ->get();

        return view('Profile-Tutor', compact('tutor', 'reviews'));
    }
}
