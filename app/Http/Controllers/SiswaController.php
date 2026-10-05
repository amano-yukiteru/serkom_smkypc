<?php

namespace App\Http\Controllers;

use App\Http\Requests\Siswa\IndexSiswaRequest;
use App\Http\Requests\Siswa\StoreSiswaRequest;
use App\Http\Requests\Siswa\UpdateSiswaRequest;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class SiswaController extends Controller
{
    /**
     * Daftar siswa dengan search, filter jenis & tahun masuk.
     */
    public function index(IndexSiswaRequest $request)
    {
        $filters = $request->validated();

        $siswa = Siswa::query()
            ->when(!empty($filters['search']), function ($q) use ($filters) {
                $q->where(function ($sub) use ($filters) {
                    $sub->where('nama_siswa', 'like', "%{$filters['search']}%")
                        ->orWhere('nisn', 'like', "%{$filters['search']}%");
                });
            })
            ->when(!empty($filters['jenis']), fn($q) =>
                $q->where('jenis', $filters['jenis'])
            )
            ->when(!empty($filters['tahun_masuk']), fn($q) =>
                $q->where('tahun_masuk', $filters['tahun_masuk'])
            )
            ->latest('id')
            ->paginate($filters['per_page'] ?? 9)
            ->withQueryString();

        // Daftar tahun unik — untuk dropdown filter
        $tahunList = Siswa::query()
            ->select('tahun_masuk')
            ->distinct()
            ->orderBy('tahun_masuk', 'desc')
            ->pluck('tahun_masuk');

        return view('pages.crud.siswa.index', compact('siswa', 'tahunList'));
    }

    public function create(): View
    {
        return view('pages.crud.siswa.create');
    }

    public function store(StoreSiswaRequest $request): RedirectResponse
    {
        $siswa = Siswa::create($request->validated());

        return redirect()
            ->route('siswa.index')
            ->with('success', "Siswa \"{$siswa->nama_siswa}\" berhasil ditambahkan.");
    }

    public function show(Siswa $siswa)
    {
        // return view('pages.crud.siswa.show', compact('siswa'));
    }


    public function update(UpdateSiswaRequest $request, Siswa $siswa): RedirectResponse
    {
        // Siswa route pakai model binding {siswa}, jadi langsung update
        $siswa->update($request->validated());

        return redirect()
            ->route('siswa.index')
            ->with('success', "Data siswa \"{$siswa->nama_siswa}\" berhasil diperbarui.");
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        $nama = $siswa->nama_siswa;
        $siswa->delete();

        return redirect()
            ->route('siswa.index')
            ->with('success', "Siswa \"{$nama}\" berhasil dihapus.");
    }
    public function edit(string $encryptedId): View
    {
        $siswa = $this->findByEncrypted($encryptedId);   // ← decrypt di sini
        return view('pages.crud.siswa.edit', compact('siswa'));
    }

    private function findByEncrypted(string $encryptedId): Siswa
    {
        try {
            $id = Crypt::decrypt($encryptedId);           // ← decrypt
        } catch (\Throwable $e) {
            abort(404);
        }
        return Siswa::findOrFail($id);
    }
}

