<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilSekolah\UpdateProfilSekolahRequest;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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

    // Foto kepala sekolah
    if ($request->hasFile('foto')) {
        if ($profil?->foto) {
            Storage::disk('public')->delete($profil->foto);
        }
        $data['foto'] = $request->file('foto')->store('profil_sekolah/foto', 'public');
    }

    if ($request->hasFile('logo')) {
        if ($profil?->logo) {
            Storage::disk('public')->delete($profil->logo);
        }
        $data['logo'] = $request->file('logo')->store('profil_sekolah/logo', 'public');
    }

    if ($request->hasFile('foto_sekolah')) {
        if ($profil?->foto_sekolah) {
            Storage::disk('public')->delete($profil->foto_sekolah);
        }
        $data['foto_sekolah'] = $request->file('foto_sekolah')->store('profil_sekolah/foto_sekolah', 'public');
    }

    $profil ? $profil->update($data) : ProfilSekolah::create($data);

    return redirect()->route('profil_sekolah.index')->with('success', 'Profil sekolah berhasil diperbarui.');
}
}
