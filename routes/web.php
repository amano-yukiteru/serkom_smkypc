<?php

use Illuminate\Support\Facades\Route;

// ============================================================
// IMPORT CONTROLLERS
// ============================================================
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\UserController;


Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::get('/', function(){
    return view('pages.company_profile.layouts.index');
});


Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard.index');

    Route::resource('berita', BeritaController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('ekstrakurikuler', EkstrakurikulerController::class);

    Route::prefix('profil-sekolah')->name('profil_sekolah.')->group(function () {
        Route::get('/index',  [ProfilSekolahController::class, 'index'])->name('index');
        Route::get('/edit',   [ProfilSekolahController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfilSekolahController::class, 'update'])->name('update');
    });

    Route::middleware('role:Admin')->group(function () {
        Route::resource('user', UserController::class);
    });
});