<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QuocGiaController;
use App\Http\Controllers\Admin\TacGiaController;
use App\Http\Controllers\Admin\TheLoaiController;
use App\Http\Controllers\Admin\TruyenController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Congtacvientruyen\CongTacVienTruyenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //home
    Route::get('home', [AdminController::class, 'home'])->name('home');
    //danh mục truyện
    Route::resource('truyen', TruyenController::class)->except('show');
    //danh mục quốc gia
    Route::resource('quocgia', QuocGiaController::class)->except('show');
    //thể loại
    Route::resource('theloai', TheLoaiController::class)->except('show');
    //tác giả
    Route::resource('tacgia', TacGiaController::class)->except('show');
});
