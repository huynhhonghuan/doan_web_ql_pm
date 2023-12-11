<?php

namespace App\Http\Controllers\Congtacvientruyen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CongTacVienTruyenController extends Controller
{
    public function home()
    {
        $title = 'Trang Cộng tác viên';
        return view('Congtacvientruyen.home', compact('title'));
    }
}
