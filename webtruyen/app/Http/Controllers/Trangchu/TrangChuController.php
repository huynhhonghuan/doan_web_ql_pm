<?php

namespace App\Http\Controllers\Trangchu;

use App\Http\Controllers\Controller;
use App\Models\Truyen;
use Illuminate\Http\Request;

class TrangChuController extends Controller
{
    public function home()
    {
        $truyen = Truyen::orderby('id', 'asc')->limit(12)->get();
        $truyenmoinhat = Truyen::orderby('id', 'asc')->limit(10)->get();
        return view('trangchu.home', compact('truyen', 'truyenmoinhat'));
    }
    public function getTruyen($id)
    {
        $truyen = Truyen::find($id);
        return view('trangchu.truyen', compact('truyen'));
    }
}
