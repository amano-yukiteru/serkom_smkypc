<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kerjasama\IndexKerjasamaRequest;
use App\Http\Requests\Kerjasama\StoreKerjasamaRequest;
use App\Http\Requests\Kerjasama\UpdateKerjasamaRequest;
use App\Models\Kerjasama;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class KerjasamaController extends Controller
{
    public function index(IndexKerjasamaRequest $request)
    {
        $validated = $request->validated();

        $search  = $validated['search']   ?? null;
        $perPage = $validated['per_page'] ?? 9;

        $kerjasama = Kerjasama::query()
            ->when($search, fn ($q) => $q->where('nama_perusahaan', 'like', "%{$search}%"))
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.crud.kerjasama.index', compact('kerjasama'));
    }

    public function create()
    {
        return view('pages.crud.kerjasama.create');
    }

    public function store(StoreKerjasamaRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kerjasama/foto', 'public');
        }

        Kerjasama::create($data);

        return redirect()->route('kerjasama.index')
            ->with('success', 'Data kerjasama berhasil ditambahkan.');
    }

    public function edit(string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $kerjasama = Kerjasama::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('kerjasama.index')
                ->with('error', 'Data tidak ditemukan.');
        }

        return view('pages.crud.kerjasama.edit', compact('kerjasama'));
    }

    public function update(UpdateKerjasamaRequest $request, string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $kerjasama = Kerjasama::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('kerjasama.index')
                ->with('error', 'Data tidak ditemukan.');
        }

        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($kerjasama->foto) {
                Storage::disk('public')->delete($kerjasama->foto);
            }
            $data['foto'] = $request->file('foto')->store('kerjasama/foto', 'public');
        }

        $kerjasama->update($data);

        return redirect()->route('kerjasama.index')
            ->with('success', 'Data kerjasama berhasil diperbarui.');
    }

    public function destroy(string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $kerjasama = Kerjasama::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('kerjasama.index')
                ->with('error', 'Data tidak ditemukan.');
        }

        if ($kerjasama->foto) {
            Storage::disk('public')->delete($kerjasama->foto);
        }

        $nama = $kerjasama->nama_perusahaan;
        $kerjasama->delete();

        return redirect()->route('kerjasama.index')
            ->with('success', 'Kerjasama "'.$nama.'" berhasil dihapus.');
    }
}