<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilSekolah\UpdateProfilSekolahRequest;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        return view('pages.crud.profil_sekolah.index', compact('profil'));
    }

    public function edit()
    {
        $profil = ProfilSekolah::first();
        return view('pages.crud.profil_sekolah.edit', compact('profil'));
    }

    public function update(UpdateProfilSekolahRequest $request)
    {
        $data = $request->validated();
        $profil = ProfilSekolah::first();

        // Hapus & simpan foto baru (kalau upload)
        if ($request->hasFile('foto')) {
            if ($profil?->foto) {
                Storage::disk('public')->delete($profil->foto);
            }
            $data['foto'] = $request->file('foto')->store('profil_sekolah/foto', 'public');
        }

        // Hapus & simpan logo baru (kalau upload)
        if ($request->hasFile('logo')) {
            if ($profil?->logo) {
                Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = $request->file('logo')->store('profil_sekolah/logo', 'public');
        }

        // Update kalau sudah ada, create kalau belum
        $profil ? $profil->update($data) : ProfilSekolah::create($data);

        return redirect()->route('profil_sekolah.index')->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
