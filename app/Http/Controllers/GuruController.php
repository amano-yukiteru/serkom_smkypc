<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guru\IndexGuruRequest;
use App\Http\Requests\Guru\StoreGuruRequest;
use App\Http\Requests\Guru\UpdateGuruRequest;
use App\Models\Guru;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(IndexGuruRequest $request)
    {
        $validated = $request->validated();

        $search = $validated['search'] ?? null;
        $sort = $validated['sort'] ?? 'created_at';
        $order = $validated['order'] ?? 'desc';
        $perPage = $validated['per_page'] ?? 10;

        $gurus = Guru::query()
            ->when($search, fn ($q) => $q->whereAny(
                ['nama_guru', 'nip', 'mapel'],
                'like',
                "%{$search}%"
            ))
            ->orderBy($sort, $order)
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.crud.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('pages.crud.guru.create');
    }

    public function store(StoreGuruRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru/foto', 'public');
        }

        Guru::create($data);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $guru = Guru::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('guru.index')->with('error', 'data tidak ditemukan');
        }

        return view('pages.crud.guru.edit', compact('guru'));
    }

    public function update(UpdateGuruRequest $request, string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $guru = Guru::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('guru.index')->with('error', 'data tidak ditemukan');
        }
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('guru/foto', 'public');
        }

        $guru->update($data);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $guru = Guru::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('guru.index')->with('error', 'data tidak ditemukan');
        }

        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }

        $nama = $guru->nama_guru;
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Guru "'.$nama.'" berhasil dihapus.');
    }
}
