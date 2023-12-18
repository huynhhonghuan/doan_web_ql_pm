<?php

namespace App\Http\Controllers\collaborators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollaboratorsMainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = 'Trang quản trị Cộng Tác Viên Phim';
        return view('layout.home', compact('title'));
    }
}
