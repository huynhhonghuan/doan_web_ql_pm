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
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    //home admin
    Route::get('/', [AdminController::class, 'home'])->name('home');
    Route::get('home', [AdminController::class, 'home'])->name('home');

    //truyện
    Route::resource('truyen', TruyenController::class)->except('show');
    Route::post('truyen/nhap', [TruyenController::class, 'postNhap'])->name('truyen.nhap'); //nhập excel
    Route::get('truyen/xuat', [TruyenController::class, 'getXuat'])->name('truyen.xuat'); //xuất excel
    Route::get('truyen/hinh', [TruyenController::class, 'getHinh'])->name('truyen.hinh'); //xuất hình file.zip

    //chi tiết truyện
    Route::resource('truyenchitiet', TruyenChiTietController::class)->except('show');
    Route::post('truyenchitiet/nhap', [TruyenChiTietController::class, 'postNhap'])->name('truyenchitiet.nhap'); //nhập excel
    Route::get('truyenchitiet/xuat', [TruyenChiTietController::class, 'getXuat'])->name('truyenchitiet.xuat'); //xuất excel
    Route::get('truyenchitiet/hinh', [TruyenChiTietController::class, 'getHinh'])->name('truyenchitiet.hinh'); //xuất hình file.zip

    //danh mục quốc gia
    Route::resource('quocgia', QuocGiaController::class)->except('show');
    Route::post('quocgia/nhap', [QuocGiaController::class, 'postNhap'])->name('quocgia.nhap'); //nhập excel
    Route::get('quocgia/xuat', [QuocGiaController::class, 'getXuat'])->name('quocgia.xuat'); //xuất excel

    //thể loại
    Route::resource('theloai', TheLoaiController::class)->except('show');
    Route::post('theloai/nhap', [TheLoaiController::class, 'postNhap'])->name('theloai.nhap'); //nhập excel
    Route::get('theloai/xuat', [TheLoaiController::class, 'getXuat'])->name('theloai.xuat'); //xuất excel

    //tác giả
    Route::resource('tacgia', TacGiaController::class)->except('show');
    Route::post('tacgia/nhap', [TacGiaController::class, 'postNhap'])->name('tacgia.nhap'); //nhập excel
    Route::get('tacgia/xuat', [TacGiaController::class, 'getXuat'])->name('tacgia.xuat'); //xuất excel
});

//Cộng tác viên truyện
Route::group(['middleware' => ['auth', 'ctvt'], 'prefix' => 'ctvt', 'as' => 'ctvt.'], function () {

    //home ctvt
    Route::get('/', [CongTacVienTruyenController::class, 'home'])->name('home');
    Route::get('home', [CongTacVienTruyenController::class, 'home'])->name('home');
    //danh mục truyện ctv
    Route::resource('truyen', ctv_truyen::class)->except('show');
});

//Người dùng
Route::group(['middleware' => ['auth', 'nguoidung'], 'prefix' => 'nguoidung', 'as' => 'nguoidung.'], function () {
});
