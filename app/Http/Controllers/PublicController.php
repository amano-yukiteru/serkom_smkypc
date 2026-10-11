<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kerjasama;
use App\Models\ProfilSekolah;
use App\Models\Siswa;

class PublicController extends Controller
{
    // ============================================================
    // LANDING PAGE
    // ============================================================
    public function home()
    {
        return view('pages.company_profile.layouts.index', [
            'profil'          => ProfilSekolah::first(),
            'totalSiswa'      => Siswa::count(),
            'totalGuru'       => Guru::count(),
            'totaljurusan'    => Jurusan::count(),
            'beritaTerbaru'   => Berita::latest('tanggal')->limit(4)->get(),
            'ekstrakurikuler' => Ekstrakurikuler::latest('id')->limit(4)->get(),
            'galeris'         => Galeri::latest('id')->limit(8)->get(),
            'gurus'           => Guru::latest('id')->limit(4)->get(),
            'jurusans'        => Jurusan::latest('id')->get(),
            'kerjasamas'      => Kerjasama::latest('id')->get(),
        ]);
    }

    // ============================================================
    // BERITA
    // ============================================================
    public function berita()
    {
        return view('pages.company_profile.pages.berita', [
            'profil' => ProfilSekolah::first(),
            'berita' => Berita::with('user:id,name')->latest('tanggal')->paginate(9),
        ]);
    }

    public function beritaDetail($id)
    {
        return view('pages.company_profile.pages.berita', [
            'profil' => ProfilSekolah::first(),
            'berita' => Berita::with('user:id,name')->findOrFail($id),
        ]);
    }

    // ============================================================
    // JURUSAN
    // ============================================================
    public function jurusan()
    {
        return view('pages.company_profile.pages.jurusan', [
            'profil'   => ProfilSekolah::first(),
            'jurusans' => Jurusan::latest('id')->paginate(12),
        ]);
    }

    // ============================================================
    // EKSTRAKURIKULER
    // ============================================================
    public function ekstrakurikuler()
    {
        return view('pages.company_profile.pages.ekstrakurikuler', [
            'profil'          => ProfilSekolah::first(),
            'ekstrakurikuler' => Ekstrakurikuler::latest('id')->paginate(12),
        ]);
    }

    // ============================================================
    // GALERI
    // ============================================================
    public function galeri()
    {
        return view('pages.company_profile.pages.galeri', [
            'profil'  => ProfilSekolah::first(),
            'galeris' => Galeri::latest('id')->paginate(16),
        ]);
    }

    // ============================================================
    // GURU
    // ============================================================
    public function guru()
    {
        return view('pages.company_profile.pages.guru', [
            'profil' => ProfilSekolah::first(),
            'gurus'  => Guru::latest('id')->paginate(20),
        ]);
    }

    // ============================================================
    // KERJASAMA
    // ============================================================
    public function kerjasama()
    {
        return view('pages.company_profile.pages.kerjasama', [
            'profil'     => ProfilSekolah::first(),
            'kerjasamas' => Kerjasama::latest('id')->paginate(20),
        ]);
    }
}