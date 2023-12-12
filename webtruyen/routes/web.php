<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QuocGiaController;
use App\Http\Controllers\Admin\TacGiaController;
use App\Http\Controllers\Admin\TheLoaiController;
use App\Http\Controllers\Admin\TruyenChiTietController;
use App\Http\Controllers\Admin\TruyenController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Congtacvientruyen\CongTacVienTruyenController;
use App\Http\Controllers\Congtacvientruyen\TruyenController as ctv_truyen;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\TruyenChiTiet;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.users.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//-------------------------------------Login--------------------------------------------//
Route::get('/login', [LoginController::class, 'login'])->name('login');
//-------------------------------------Login xử lý--------------------------------------------//
Route::post('/login', [LoginController::class, 'login_xuly']);
//-------------------------------------Logout--------------------------------------------//
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Admin
Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //home
    Route::get('home', [AdminController::class, 'home'])->name('home');
    //danh mục truyện
    Route::resource('truyen', TruyenController::class)->except('show');
    //chi tiết truyện
    Route::resource('truyenchitiet', TruyenChiTietController::class)->except('show');
    //danh mục quốc gia
    Route::resource('quocgia', QuocGiaController::class)->except('show');
    //thể loại
    Route::resource('theloai', TheLoaiController::class)->except('show');
    //tác giả
    Route::resource('tacgia', TacGiaController::class)->except('show');
});

//Cộng tác viên truyện
Route::group(['middleware' => 'auth', 'prefix' => 'ctvt', 'as' => 'ctvt.'], function () {
    //home ctvt
    Route::get('home', [CongTacVienTruyenController::class, 'home'])->name('home');
    //danh mục truyện ctv
    Route::resource('truyen', ctv_truyen::class)->except('show');
});

//Người dùng
