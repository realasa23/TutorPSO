<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class reviewController extends Controller
{
    public function reviewTutor()
    {
        return view('Review');
    }
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1', 
            'ulasan' => 'nullable|string',
        ]);

     
        $lastReview = Review::orderBy('idreview', 'desc')->first();
        
        if ($lastReview) {
            $number = intval(substr($lastReview->idreview, 1)) + 1;
        } else {
            $number = 1;
        }
        
        $newId = 'R' . str_pad($number, 2, '0', STR_PAD_LEFT);

        Review::create([
            'idreview'      => $newId, 
            'idpesanan'     => 'P05',  
            'rating'        => $request->rating,
            'tagpenilaian'  => $request->tagpenilaian, 
            'komentar'      => $request->ulasan,       
            'tanggalreview' => now(),
        ]);

        return redirect()->route('review.selesai');
    }
    public function reviewSelesai()
    {
        return view('Review-Selesai');
    }
}
