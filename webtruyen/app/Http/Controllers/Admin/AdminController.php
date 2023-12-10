<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        $title = 'Trang quản trị Admin';
        return view('admin.home', compact('title'));
    }
}
