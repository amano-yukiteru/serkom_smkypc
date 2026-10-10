<?php

namespace App\Http\Controllers;

use App\Http\Requests\Berita\IndexBeritaRequest;
use App\Http\Requests\Berita\StoreBeritaRequest;
use App\Http\Requests\Berita\UpdateBeritaRequest;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(IndexBeritaRequest $request)
    {
        $validated = $request->validated();

        $search = $validated['search'] ?? null;
        $bulan = $validated['bulan'] ?? null;
        $tahun = $validated['tahun'] ?? null;
        $sort = $validated['sort'] ?? 'tanggal';
        $order = $validated['order'] ?? 'desc';
        $perPage = $validated['per_page'] ?? 9;

        $beritas = Berita::query()
            ->with('user:id,name')
            ->when($search, fn ($q) => $q->whereAny(['judul', 'isi'], 'like', "%{$search}%"))
            ->when($bulan, fn ($q) => $q->whereMonth('tanggal', $bulan))
            ->when($tahun, fn ($q) => $q->whereYear('tanggal', $tahun))
            ->orderBy($sort, $order)
            ->paginate($perPage)
            ->withQueryString();

        $tahunList = Berita::query()
            ->selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('pages.crud.berita.index', compact('beritas', 'tahunList'));
    }

    public function create()
    {
        return view('pages.crud.berita.create');
    }

    public function store(StoreBeritaRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita/gambar', 'public');
        }

        $data['user_id'] = Auth::id();

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(string $encryptedId)
    {
        //
    }

    public function edit(string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $berita = Berita::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('berita.index')->with('error', 'data tidak ditemukan');
        }

        return view('pages.crud.berita.edit', compact('berita'));
    }

    public function update(UpdateBeritaRequest $request, string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $berita = Berita::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('berita.index')->with('error', 'data tidak ditemukan');
        }
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita/gambar', 'public');
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $berita = Berita::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('berita.index')->with('error', 'data tidak ditemukan');
        }

        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $judul = $berita->judul;
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita "'.$judul.'" berhasil dihapus.');
    }
}
