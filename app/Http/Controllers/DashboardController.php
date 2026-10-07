<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\ProfilSekolah;
use App\Models\Siswa;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Profil sekolah (single record)
        $profil = ProfilSekolah::first();

        $totalUser = User::count();
        $totalJurusan = Jurusan::count();
        $totalGaleri = Galeri::count();
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalEskul = Ekstrakurikuler::count();

        $berita = Berita::query()
            ->with('user:id,name')
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        $ekstrakurikuler = Ekstrakurikuler::query()
            ->latest('id')
            ->limit(3)
            ->get();

        $galeris = Galeri::query()
            ->latest('id')
            ->limit(8)
            ->get();

        $gurus = Guru::query()
            ->latest('id')
            ->limit(5)
            ->get();

        return view('pages.company_profile.index', compact(
            // 'profil',
            'berita',
            'ekstrakurikuler',
            'galeris',
            'gurus',
            'jurusan',
            
            'totalUser',
            'totalGaleri',
            'totalJurusan',
            'totalSiswa',
            'totalGuru',
            'totalEskul',
            
        ));
    }

    public function admin()
    {
        // Statistik
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalEskul = Ekstrakurikuler::count();

        // Berita terbaru (3 item)
        $beritaTerbaru = Berita::query()
            ->with('user:id,name')
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        // Ekstrakurikuler (3 item terbaru)
        $ekstrakurikuler = Ekstrakurikuler::query()
            ->latest('id')
            ->limit(3)
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
}
