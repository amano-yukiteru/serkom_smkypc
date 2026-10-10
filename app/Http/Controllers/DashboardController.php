<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kerjasama;
use App\Models\Siswa;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index', [
            'totalBerita'           => Berita::count(),
            'totalGuru'             => Guru::count(),
            'totalSiswa'            => Siswa::count(),
            'totalGaleri'           => Galeri::count(),
            'totalEkstrakurikuler'  => Ekstrakurikuler::count(),
            'totalJurusan'          => Jurusan::count(),
            'totalKerjasama'        => Kerjasama::count(),
            'totalUser'             => User::count(),

            'beritas'               => Berita::latest()->take(3)->get(),
            'gurus'                 => Guru::latest()->take(3)->get(),
            'siswas'                => Siswa::latest()->take(3)->get(),
            'galeris'               => Galeri::latest()->take(3)->get(),
            'jurusans'              => Jurusan::latest()->take(3)->get(),
            'kerjasamas'            => Kerjasama::latest()->take(3)->get(),
            'ekstrakurikulers'      => Ekstrakurikuler::latest()->take(3)->get(),
        ]);
    }
}