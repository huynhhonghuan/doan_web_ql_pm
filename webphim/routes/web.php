<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
//admin controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;

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

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim', [IndexController::class, 'watch'])->name('watch');
Route::get('/episode', [IndexController::class, 'episode'])->name('episode');

//route admin
Route::prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'postlogin'])->name('postlogin');
});
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('main', [MainController::class, 'index'])->name('main');
        Route::get('/', [MainController::class, 'index'])->name('admin');

        //danh muc
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('list', [CategoryController::class, 'show'])->name('list');
            Route::get('add', [CategoryController::class, 'create'])->name('add');
            Route::post('add', [CategoryController::class, 'postcreate'])->name('postadd');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('edit', [CategoryController::class, 'postedit'])->name('postedit');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
        });

        //the loai
        Route::prefix('genre')->name('genre.')->group(function () {
            Route::get('list', [GenreController::class, 'show'])->name('list');
            Route::get('add', [GenreController::class, 'create'])->name('add');
            Route::post('add', [GenreController::class, 'postcreate'])->name('postadd');
            Route::get('edit/{id}', [GenreController::class, 'edit'])->name('edit');
            Route::post('edit', [GenreController::class, 'postedit'])->name('postedit');
            Route::get('delete/{id}', [GenreController::class, 'delete'])->name('delete');
        });

        //quoc gia
        Route::prefix('country')->name('country.')->group(function () {
            Route::get('list', [CountryController::class, 'show'])->name('list');
            Route::get('add', [CountryController::class, 'create'])->name('add');
            Route::post('add', [CountryController::class, 'postcreate'])->name('postadd');
            Route::get('edit/{id}', [CountryController::class, 'edit'])->name('edit');
            Route::post('edit', [CountryController::class, 'postedit'])->name('postedit');
            Route::get('delete/{id}', [CountryController::class, 'delete'])->name('delete');
        });

        //phim
        Route::prefix('movie')->name('movie.')->group(function () {
            Route::get('list', [MovieController::class, 'show'])->name('list');
            Route::get('add', [MovieController::class, 'create'])->name('add');
            Route::post('add', [MovieController::class, 'postcreate'])->name('postadd');
            Route::get('edit/{id}', [MovieController::class, 'edit'])->name('edit');
            Route::post('edit', [MovieController::class, 'postedit'])->name('postedit');
            Route::get('delete/{id}', [MovieController::class, 'delete'])->name('delete');
        });
    });
});
