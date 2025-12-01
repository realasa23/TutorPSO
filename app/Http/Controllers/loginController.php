<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class loginController extends Controller
{
    public function index()
    {
        $user = DB::table('user')->get();
        return view('page_awal', ['user' => $user]);
    }
}
