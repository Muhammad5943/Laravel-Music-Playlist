<?php

use App\Http\Controllers\{HomeController, DashboardController};
use App\Http\Controllers\Band\{AlbumController, BandController, GenreController, LyricController, SearchController};
use Illuminate\Support\Facades\{Route, Auth};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', HomeController::class)->name('home');
Route::get('/search', SearchController::class)->name('search');

Route::middleware('auth')->group(function(){
    
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('/bands')->group(function(){
        // Create
        Route::get('/create', [BandController::class, 'create'])->name('bands.create');
        Route::post('/create', [BandController::class, 'store']);
        // Table
        Route::get('/table', [BandController::class, 'table'])->name('bands.table');
        // Band
        Route::get('/{band:slug}', [BandController::class, 'show'])->name('bands.show')->withoutMiddleware('auth');
        Route::get('/{band:slug}/edit', [BandController::class, 'edit'])->name('bands.edit');
        Route::put('/{band:slug}/edit', [BandController::class, 'update']);
        Route::delete('/{band:slug}/delete', [BandController::class, 'destroy'])->name('bands.delete');
    });

    Route::prefix('albums')->group(function() {
        // Create
        Route::get('create', [AlbumController::class, 'create'])->name('albums.create');
        Route::post('create', [AlbumController::class, 'store']);
        // Table
        Route::get('table', [AlbumController::class, 'table'])->name('albums.table');
        // Album
        Route::get('{album:slug}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
        Route::put('{album:slug}/edit', [AlbumController::class, 'update']);
        Route::delete('{album:slug}/delete', [AlbumController::class, 'destroy'])->name('albums.delete');
        // API
        Route::get('/get-album-by-{band}', [AlbumController::class, 'getAlbumsByBandId']);
    });

    Route::prefix('genres')->group(function() {
        // Create
        Route::get('create', [GenreController::class, 'create'])->name('genres.create');
        Route::post('create', [GenreController::class, 'store']);
        // Table
        Route::get('table', [GenreController::class, 'table'])->name('genres.table');
        // Genre
        Route::get('{genre:slug}', [GenreController::class, 'show'])->name('genres.show')->withoutMiddleware('auth');
        Route::get('{genre:slug}/edit', [GenreController::class, 'edit'])->name('genres.edit');
        Route::put('{genre:slug}/edit', [GenreController::class, 'update']);
        Route::delete('{genre:slug}/delete', [GenreController::class, 'destroy'])->name('genres.delete');
    });

    Route::prefix('lyrics')->group(function() {
        // Create
        Route::get('create', [LyricController::class, 'create'])->name('lyrics.create');
        Route::post('create', [LyricController::class, 'store']);
        // Table
        Route::get('table', [LyricController::class, 'table'])->name('lyrics.table');
        Route::get('data-table', [LyricController::class, 'dataTable'])->name('lyrics.datatable');
        //Lyric
        Route::get('{lyric:slug}/edit', [LyricController::class, 'edit']);
        Route::put('{lyric:slug}', [LyricController::class, 'update']);
        Route::delete('{lyric:slug}/delete', [LyricController::class, 'destroy']);
    });

});

Route::get('{band:slug}/{lyric:slug}', [LyricController::class, 'show'])->name('lyrics.show');
