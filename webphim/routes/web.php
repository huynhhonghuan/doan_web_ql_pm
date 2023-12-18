<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
//admin controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\collaborators\CollaboratorEpisodeController;
use App\Http\Controllers\collaborators\CollaboratorMovieController;
use App\Http\Controllers\collaborators\CollaboratorsMainController;
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
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watch']);
Route::get('/episode', [IndexController::class, 'episode'])->name('episode');
Route::get('/tag/{tag}', [IndexController::class, 'tag'])->name('tag');
Route::get('/tim-kiem', [IndexController::class, 'search'])->name('search');


Route::prefix('users')->name('users.')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'postlogin'])->name('postlogin');
    Route::post('/logout', [LoginController::class, 'postlogout'])->name('postlogout');
});
Route::middleware(['auth', 'admin'])->group(function () {
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
            Route::get('update-year-movie', [MovieController::class, 'update_year'])->name('update_year');
        });

        //tap phim
        Route::prefix('episode')->name('episode.')->group(function () {
            Route::get('list', [EpisodeController::class, 'show'])->name('list');
            Route::get('add/{id}', [EpisodeController::class, 'create'])->name('add');
            Route::post('add', [EpisodeController::class, 'postcreate'])->name('postadd');
            Route::get('edit/{id}', [EpisodeController::class, 'edit'])->name('edit');
            Route::post('edit', [EpisodeController::class, 'postedit'])->name('postedit');
            Route::get('delete/{id}', [EpisodeController::class, 'delete'])->name('delete');
        });
    });
});
Route::middleware(['auth', 'ctvp'])->group(function () {
    Route::prefix('collaborators')->name('collaborators.')->group(function () {
        Route::get('main', [CollaboratorsMainController::class, 'index'])->name('main');
        Route::get('/', [CollaboratorsMainController::class, 'index'])->name('collaborators');

        //phim
        Route::prefix('movie')->name('movie.')->group(function () {
            Route::get('list', [CollaboratorMovieController::class, 'show'])->name('list');
            Route::get('add', [CollaboratorMovieController::class, 'create'])->name('add');
            Route::post('add', [CollaboratorMovieController::class, 'postcreate'])->name('postadd');
            Route::get('edit/{id}', [CollaboratorMovieController::class, 'edit'])->name('edit');
            Route::post('edit', [CollaboratorMovieController::class, 'postedit'])->name('postedit');
            Route::get('delete/{id}', [CollaboratorMovieController::class, 'delete'])->name('delete');
            Route::get('update-year-movie', [CollaboratorMovieController::class, 'update_year'])->name('update_year');
        });

        //tap phim
        Route::prefix('episode')->name('episode.')->group(function () {
            Route::get('list', [CollaboratorEpisodeController::class, 'show'])->name('list');
            Route::get('add/{id}', [CollaboratorEpisodeController::class, 'create'])->name('add');
            Route::post('add', [CollaboratorEpisodeController::class, 'postcreate'])->name('postadd');
            Route::get('edit/{id}', [CollaboratorEpisodeController::class, 'edit'])->name('edit');
            Route::post('edit', [CollaboratorEpisodeController::class, 'postedit'])->name('postedit');
            Route::get('delete/{id}', [CollaboratorEpisodeController::class, 'delete'])->name('delete');
        });
    });
});
