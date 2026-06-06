<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Harya Raditya Handoyo - 5026231176
// Nailah Adlina - 5026231068

class TutorController extends Controller
{
    private function attachRating($tutor)
    {
        foreach ($tutor as $t) {
            $t->ratingtutor  = DB::table('review')
                ->join('pesanan', 'review.idpesanan', '=', 'pesanan.idpesanan')
                ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
                ->where('sesi.idtutor', $t->idtutor)
                ->avg('review.rating') ?? 0;

            $t->total_review = DB::table('review')
                ->join('pesanan', 'review.idpesanan', '=', 'pesanan.idpesanan')
                ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
                ->where('sesi.idtutor', $t->idtutor)
                ->count();
        }
        return $tutor;
    }

    public function recTutor()
    {
        $tutor = DB::table('tutor')->get();
        $tutor = $this->attachRating($tutor);
        return view('List-Tutor', compact('tutor'));
    }

    public function profile($id)
    {
        $tutor = DB::table('tutor')->where('idtutor', $id)->first();

        if (!$tutor) {
            abort(404, 'Tutor tidak ditemukan');
        }

        $tutorCollection = collect([$tutor]);
        $tutorCollection = $this->attachRating($tutorCollection);
        $tutor = $tutorCollection->first();

        $reviews = DB::table('review')
            ->join('pesanan', 'review.idpesanan', '=', 'pesanan.idpesanan')
            ->join('sesi', 'pesanan.idsesi', '=', 'sesi.idsesi')
            ->join('users', 'pesanan.userid', '=', 'users.id')
            ->where('sesi.idtutor', $id)
            ->select('review.*', 'users.name as nama_user')
            ->get();

        return view('Profile-Tutor', compact('tutor', 'reviews'));
    }

    public function listSesi($idtutor)
    {
        $tutor = DB::table('tutor')->where('idtutor', $idtutor)->first();

        if (!$tutor) {
            abort(404, 'Tutor tidak ditemukan');
        }

        $tutorCollection = collect([$tutor]);
        $tutorCollection = $this->attachRating($tutorCollection);
        $tutor = $tutorCollection->first();

        $sesi = DB::table('sesi')
            ->join('matakuliah', 'sesi.idmatkul', '=', 'matakuliah.idmatkul')
            ->where('sesi.idtutor', $idtutor)
            ->select('sesi.*', 'matakuliah.namamatkul')
            ->get();

        return view('Daftar-Sesi-Tutor', compact('tutor', 'sesi'));
    }
}