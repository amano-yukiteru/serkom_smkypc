<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CompanyProfil;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;


Route::get('/', [CompanyProfil::class, 'index'])->name('home');

Route::prefix('publik')->name('publik.')->group(function () {
    Route::get('/berita',          [CompanyProfil::class, 'berita'])->name('berita');
    Route::get('/berita/{id}',     [CompanyProfil::class, 'beritaDetail'])->name('berita.detail');
    Route::get('/jurusan',         [CompanyProfil::class, 'jurusan'])->name('jurusan');
    Route::get('/ekstrakurikuler', [CompanyProfil::class, 'ekstrakurikuler'])->name('ekstrakurikuler');
    Route::get('/galeri',          [CompanyProfil::class, 'galeri'])->name('galeri');
    Route::get('/guru',            [CompanyProfil::class, 'guru'])->name('guru');
    Route::get('/kerjasama',       [CompanyProfil::class, 'kerjasama'])->name('kerjasama');
});


Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});


Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('berita', BeritaController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('ekstrakurikuler', EkstrakurikulerController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('kerjasama', KerjasamaController::class);

    Route::prefix('profil-sekolah')->name('profil_sekolah.')->group(function () {
        Route::get('/index',  [ProfilSekolahController::class, 'index'])->name('index');
        Route::get('/edit',   [ProfilSekolahController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfilSekolahController::class, 'update'])->name('update');
    });

    Route::middleware('role:Admin')->group(function () {
        Route::resource('user', UserController::class);
    });
});