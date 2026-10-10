<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\ProfilSekolah;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;

class CompanyProfil extends Controller
{
    public function index()
    {
        // Profil sekolah (single record)
        $profil = ProfilSekolah::first();

        // Statistik
        $totalSiswa = Siswa::count();
        $totalGuru  = Guru::count();
        $totalEskul = Ekstrakurikuler::count();

        // Berita terbaru (3 item)
        $beritaTerbaru = Berita::query()
            ->with('user:id,name')
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        // Ekstrakurikuler (4 item)
        $ekstrakurikuler = Ekstrakurikuler::query()
            ->latest('id')
            ->limit(4)
            ->get();

        // Galeri (8 item)
        $galeris = Galeri::query()
            ->latest('id')
            ->limit(8)
            ->get();

        // Guru (5 item)
        $gurus = Guru::query()
            ->latest('id')
            ->limit(5)
            ->get();

        return view('pages.company_profile.index', compact(
            'profil',
            'totalSiswa',
            'totalGuru',
            'totalEskul',
            'beritaTerbaru',
            'ekstrakurikuler',
            'galeris',
            'gurus',
        ));
    }

    // /**
    //  * ============================================
    //  * DASHBOARD ADMIN
    //  * URL: /dashboard
    //  * ============================================
    //  */
    public function admin()
    {
        // Statistik
        $totalSiswa  = Siswa::count();
        $totalGuru   = Guru::count();
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalEskul  = Ekstrakurikuler::count();

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