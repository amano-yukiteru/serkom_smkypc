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

class CompanyProfil extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();

        $totalSiswa   = Siswa::count();
        $totalGuru    = Guru::count();
        $totaljurusan = Jurusan::count();

        $beritaTerbaru = Berita::query()
            ->with('user:id,name')
            ->orderBy('tanggal', 'desc')
            ->limit(4)
            ->get();

        $ekstrakurikuler = Ekstrakurikuler::query()->latest('id')->limit(4)->get();
        $galeris         = Galeri::query()->latest('id')->limit(8)->get();
        $gurus           = Guru::query()->latest('id')->limit(4)->get();
        $jurusans        = Jurusan::query()->latest('id')->get();
        $kerjasamas      = Kerjasama::query()->latest('id')->get();

        return view('pages.company_profile.pages.utama', compact(
            'totalSiswa',
            'totalGuru',
            'totaljurusan',
            'beritaTerbaru',
            'ekstrakurikuler',
            'galeris',
            'gurus',
            'jurusans',
            'kerjasamas',
        ));
    }


    // ============================================================
    // HALAMAN PUBLIK
    // ============================================================
    public function berita()
    {
        return view('pages.company_profile.pages.berita', [   // ⬅️ FIX
            'profil' => ProfilSekolah::first(),
            'berita' => Berita::with('user:id,name')->latest('tanggal')->paginate(9),
        ]);
    }

    // public function beritaDetail($id)
    // {
    //     return view('pages.company_profile.pages.berita-detail', [   // ⬅️ FIX
    //         'profil' => ProfilSekolah::first(),
    //         'berita' => Berita::with('user:id,name')->findOrFail($id),
    //     ]);
    // }

    public function jurusan()
    {
        return view('pages.company_profile.pages.jurusan', [   // ⬅️ FIX
            'profil'   => ProfilSekolah::first(),
            'jurusans' => Jurusan::latest('id')->paginate(12),
        ]);
    }

    public function ekstrakurikuler()
    {
        return view('pages.company_profile.pages.ekstrakurikuler', [   // ⬅️ FIX
            'profil'          => ProfilSekolah::first(),
            'ekstrakurikuler' => Ekstrakurikuler::latest('id')->paginate(12),
        ]);
    }

    public function galeri()
    {
        return view('pages.company_profile.pages.galeri', [   // ⬅️ FIX
            'profil'  => ProfilSekolah::first(),
            'galeris' => Galeri::latest('id')->paginate(16),
        ]);
    }

    public function guru()
    {
        return view('pages.company_profile.pages.guru', [   // ⬅️ FIX
            'profil' => ProfilSekolah::first(),
            'gurus'  => Guru::latest('id')->paginate(20),
        ]);
    }

    public function kerjasama()
    {
        return view('pages.company_profile.pages.kerjasama', [   // ⬅️ FIX
            'profil'     => ProfilSekolah::first(),
            'kerjasamas' => Kerjasama::latest('id')->paginate(20),
        ]);
    }
}