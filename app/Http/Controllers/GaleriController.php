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
            ->when($search, fn ($q) => $q->whereAny(
                ['judul', 'keterangan'],
                'like',
                "%{$search}%"
            ))
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
            $file = $request->file('file');

            $data['kategori'] = str_starts_with($file->getMimeType(), 'video/')
                ? 'Video'
                : 'Foto';

            $data['file'] = $file->store('galeri', 'public');
        }

        Galeri::create($data);

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(string $encryptedId)
    {
        //
    }

    public function edit(string $encryptedId)
    {
         try {
            $id = Crypt::decrypt($encryptedId);
            $galeri = Galeri::findOrFail($id);
        //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('galeri.index')->with('error', 'data tidak ditemukan');
        }

        return view('pages.crud.galeri.edit', compact('galeri'));
    }

    public function update(UpdateGaleriRequest $request, string $encryptedId)
    {
         try {
            $id = Crypt::decrypt($encryptedId);
            $galeri = Galeri::findOrFail($id);
        //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('galeri.index')->with('error', 'data tidak ditemukan');
        }
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            if ($galeri->file) {
                Storage::disk('public')->delete($galeri->file);
            }

            $data['kategori'] = str_starts_with($file->getMimeType(), 'video/')
                ? 'Video'
                : 'Foto';

            $data['file'] = $file->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(string $encryptedId)
    {
         try {
            $id = Crypt::decrypt($encryptedId);
            $galeri = Galeri::findOrFail($id);
        //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('galeri.index')->with('error', 'data tidak ditemukan');
        }

        if ($galeri->file) {
            Storage::disk('public')->delete($galeri->file);
        }

        $judul = $galeri->judul;
        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Galeri "'.$judul.'" berhasil dihapus.');
    }
}
