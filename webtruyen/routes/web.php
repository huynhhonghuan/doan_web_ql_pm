<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QuocGiaController;
use App\Http\Controllers\Admin\TacGiaController;
use App\Http\Controllers\Admin\TaiKhoanController;
use App\Http\Controllers\Admin\TheLoaiController;
use App\Http\Controllers\Admin\TruyenChiTietController;
use App\Http\Controllers\Admin\TruyenController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Congtacvientruyen\CongTacVienTruyenController;
use App\Http\Controllers\Congtacvientruyen\TruyenController as ctv_truyen;
use App\Http\Controllers\Congtacvientruyen\TruyenChiTietController as ctv_truyenct;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Trangchu\TrangChuController;
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

Route::get('/', [TrangChuController::class, 'home'])->name('home');

Auth::routes();


//-------------------------------------Login--------------------------------------------//
Route::get('/login', [LoginController::class, 'login'])->name('login');
//-------------------------------------Login xử lý--------------------------------------------//
Route::post('/login', [LoginController::class, 'login_xuly']);
//-------------------------------------Logout--------------------------------------------//
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Trang chu
Route::get('/home', [TrangChuController::class, 'home'])->name('home');
Route::get('/truyen/{id}',[TrangChuController::class,'getTruyen'])->name('truyen');
Route::get('/truyen/{id}/{chuong}',[TrangChuController::class,'getTruyenChiTiet'])->name('truyenchitiet');

//Admin
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    //home admin
    Route::get('/', [AdminController::class, 'home'])->name('home');
    Route::get('home', [AdminController::class, 'home'])->name('home');

    //tài khoản
    Route::resource('taikhoan', TaiKhoanController::class)->except('show');
    Route::get('taikhoan/xuat', [TaiKhoanController::class, 'getXuat'])->name('taikhoan.xuat');
    Route::post('taikhoan/nhap', [TaiKhoanController::class, 'postNhap'])->name('taikhoan.nhap');
    Route::get('taikhoan/khoa/{id}', [TaiKhoanController::class, 'getKhoa'])->name('taikhoan.khoa');

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
    Route::post('truyen/nhap', [ctv_truyen::class, 'postNhap'])->name('truyen.nhap'); //nhập excel
    Route::get('truyen/xuat', [ctv_truyen::class, 'getXuat'])->name('truyen.xuat'); //xuất excel
    Route::get('truyen/hinh', [ctv_truyen::class, 'getHinh'])->name('truyen.hinh'); //xuất hình file.zip

    //chi tiết truyện
    Route::resource('truyenchitiet', ctv_truyenct::class)->except('show');
    Route::post('truyenchitiet/nhap', [ctv_truyenct::class, 'postNhap'])->name('truyenchitiet.nhap'); //nhập excel
    Route::get('truyenchitiet/xuat', [ctv_truyenct::class, 'getXuat'])->name('truyenchitiet.xuat'); //xuất excel
    Route::get('truyenchitiet/hinh', [ctv_truyenct::class, 'getHinh'])->name('truyenchitiet.hinh'); //xuất hình file.zip

});

//Người dùng
Route::group(['middleware' => ['auth', 'nguoidung'], 'prefix' => 'nguoidung', 'as' => 'nguoidung.'], function () {
});
