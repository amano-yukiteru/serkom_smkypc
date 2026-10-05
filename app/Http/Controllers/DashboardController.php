<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\ProfilSekolah;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalSiswa  = Siswa::count();
        $totalGuru   = Guru::count();
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalEskul  = Ekstrakurikuler::count();

        // Berita terbaru (4 item)
        $beritaTerbaru = Berita::query()
            ->with('user:id,name')
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        // Ekstrakurikuler (5 item terbaru)
        $ekstrakurikuler = Ekstrakurikuler::query()
            ->latest('id')
            ->limit(5)
            ->get();

        // Profil sekolah
        $profil = ProfilSekolah::first();

        return view('pages.dashboard.index', compact(
            'totalSiswa',
            'totalGuru',
            'totalBerita',
            'totalGaleri',
            'totalEskul',
            'beritaTerbaru',
            'ekstrakurikuler',
            'profil',
        ));
    }

    public function show()
    {
        return view('pages.dashboard.show');
    }
}