<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

// Harya Raditya Handoyo - 5026231176
// Nailah Adlina - 5026231068

class tutorController extends Controller
{
    public function recTutor()
    {
        // --- BYPASS SEMENTARA: DUMMY DATA TUTOR ---
        $tutor = collect([
            (object)[
                'idtutor' => 1,
                'nama' => 'Sasha',
                'pekerjaan' => 'PWEB Developer',
                'fototutor' => 'https://ui-avatars.com/api/?name=Sasha&background=random',
                'ratingtutor' => 4.9,
                'total_review' => 88
            ],
            (object)[
                'idtutor' => 2,
                'nama' => 'Haryadi',
                'pekerjaan' => 'UX Design',
                'fototutor' => 'https://ui-avatars.com/api/?name=Haryadi&background=random',
                'ratingtutor' => 4.9,
                'total_review' => 75
            ],
            (object)[
                'idtutor' => 3,
                'nama' => 'Khalila',
                'pekerjaan' => 'Data Analyst',
                'fototutor' => 'https://ui-avatars.com/api/?name=Khalila&background=random',
                'ratingtutor' => 4.8,
                'total_review' => 60
            ]
        ]);

        return view('List-Tutor', compact('tutor'));
    }

    public function profile($id)
    {
        $tutor = (object) ['idtutor' => $id, 'nama' => 'Tutor Dummy', 'pekerjaan' => 'Tutor Profesional', 'deskripsi' => 'Deskripsi Tutor Dummy', 'fototutor' => null, 'ratingtutor' => 5, 'total_review' => 0];
        $reviews = collect([]);
        return view('Profile-Tutor', compact('tutor', 'reviews'));
    }

    public function listSesi($idtutor)
    {
        $tutor = (object) ['idtutor' => $idtutor, 'nama' => 'Tutor Dummy'];
        $sesi = collect([]);
        return view('Daftar-Sesi-Tutor', compact('tutor', 'sesi'));
    }
}