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
    /**
     * Tampilkan daftar guru.
     */
    public function index(IndexGuruRequest $request)
    {
        $validated = $request->validated();

        $search  = $validated['search']   ?? null;
        $sort    = $validated['sort']     ?? 'created_at';
        $order   = $validated['order']    ?? 'desc';
        $perPage = $validated['per_page'] ?? 10;

        $gurus = Guru::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('nama_guru', 'like', "%{$search}%")
                       ->orWhere('nip', 'like', "%{$search}%")
                       ->orWhere('mapel', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $order)
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.crud.guru.index', compact('gurus'));
    }

    /**
     * Form tambah guru.
     */
    public function create()
    {
        return view('pages.crud.guru.create');
    }

    /**
     * Simpan guru baru.
     */
    public function store(StoreGuruRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru/foto', 'public');
        }

        Guru::create($data);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Form edit guru.
     */
    public function edit(string $encryptedId)
    {
        $guru = $this->findByEncrypted($encryptedId);

        return view('pages.crud.guru.edit', compact('guru'));
    }

    public function update(UpdateGuruRequest $request, string $encryptedId)
    {
        $guru = $this->findByEncrypted($encryptedId);
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('guru/foto', 'public');
        }

        $guru->update($data);

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(string $encryptedId)
    {
        $guru = $this->findByEncrypted($encryptedId);

        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $nama = $guru->nama_guru;
        $guru->delete();

        return redirect()
            ->route('guru.index')
            ->with('success', 'Guru "' . $nama . '" berhasil dihapus.');
    }

    private function findByEncrypted(string $id): Guru
    {
        if (empty($id)) {
            abort(404);
        }

        try {
            $id = (int) Crypt::decrypt($id);
        } catch (\Throwable $e) {
            abort(404);
        }

        return Guru::findOrFail($id);
    }
}