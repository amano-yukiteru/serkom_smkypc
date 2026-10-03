<?php

namespace App\Http\Controllers;

use App\Http\Requests\Galeri\IndexGaleriRequest;
use App\Http\Requests\Galeri\StoreGaleriRequest;
use App\Http\Requests\Galeri\UpdateGaleriRequest;
use App\Models\Galeri;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(IndexGaleriRequest $request)
    {
        $validated = $request->validated();

        $search = $validated['search'] ?? null;
        $kategori = $validated['kategori'] ?? null;
        $sort = $validated['sort'] ?? 'created_at';
        $order = $validated['order'] ?? 'desc';
        $perPage = $validated['per_page'] ?? 9;

        $galeris = Galeri::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('judul', 'like', "%{$search}%")
                        ->orWhere('keteranga', 'like', "%{$search}%");
                });
            })
            ->when($kategori, fn ($q) => $q->where('kategori', $kategori))
            ->orderBy($sort, $order)
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.crud.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('pages.crud.galeri.create');
    }

    public function store(StoreGaleriRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('galeri', 'public');
        }

        Galeri::create($data);

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(string $encryptedId)
    {
        // $galeri = $this->findByEncrypted($encryptedId);

        // return view('pages.crud.galeri.show', compact('galeri'));
    }

    public function edit(string $encryptedId)
    {
        $galeri = $this->findByEncrypted($encryptedId);

        return view('pages.crud.galeri.edit', compact('galeri'));
    }

    public function update(UpdateGaleriRequest $request, string $encryptedId)
    {
        $galeri = $this->findByEncrypted($encryptedId);
        $data = $request->validated();

        // Kalau upload file baru → hapus lama, simpan baru
        if ($request->hasFile('file')) {
            if ($galeri->file) {
                Storage::disk('public')->delete($galeri->file);
            }
            $data['file'] = $request->file('file')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(string $encryptedId)
    {
        $galeri = $this->findByEncrypted($encryptedId);

        // Hapus file dari storage
        if ($galeri->file) {
            Storage::disk('public')->delete($galeri->file);
        }

        $judul = $galeri->judul;
        $galeri->delete();

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Galeri "'.$judul.'" berhasil dihapus.');
    }

    private function findByEncrypted(string $encryptedId): Galeri
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (\Throwable $e) {
            abort(404);
        }

        return Galeri::findOrFail($id);
    }
}
