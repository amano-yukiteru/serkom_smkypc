<?php

namespace App\Http\Controllers;

use App\Http\Requests\Siswa\IndexSiswaRequest;
use App\Http\Requests\Siswa\StoreSiswaRequest;
use App\Http\Requests\Siswa\UpdateSiswaRequest;
use App\Models\Siswa;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    public function index(IndexSiswaRequest $request)
    {
        $filters = $request->validated();

        $siswa = Siswa::query()
            ->when(! empty($filters['search']), fn ($q) => $q->whereAny(
                ['nama_siswa', 'nisn'],
                'like',
                "%{$filters['search']}%"
            ))
            ->when(! empty($filters['jenis']), fn ($q) => $q->where('jenis', $filters['jenis']))
            ->when(! empty($filters['tahun_masuk']), fn ($q) => $q->where('tahun_masuk', $filters['tahun_masuk']))
            ->latest('id')
            ->paginate($filters['per_page'] ?? 9)
            ->withQueryString();

        $tahunList = Siswa::query()
            ->select('tahun_masuk')
            ->distinct()
            ->orderBy('tahun_masuk', 'desc')
            ->pluck('tahun_masuk');

        return view('pages.crud.siswa.index', compact('siswa', 'tahunList'));
    }

    public function create()
    {
        return view('pages.crud.siswa.create');
    }

    public function store(StoreSiswaRequest $request)
    {
        $siswa = Siswa::create($request->validated());

        return redirect()
            ->route('siswa.index')
            ->with('success', "Siswa \"{$siswa->nama_siswa}\" berhasil ditambahkan.");
    }

    public function show(string $encryptedId)
    {
        //
    }

    public function edit(string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $siswa = Siswa::findOrFail($id);

        return view('pages.crud.siswa.edit', compact('siswa'));
    }

    public function update(UpdateSiswaRequest $request, string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $siswa = Siswa::findOrFail($id);

        $siswa->update($request->validated());

        return redirect()->route('siswa.index')->with('success', "Data siswa \"{$siswa->nama_siswa}\" berhasil diperbarui.");
    }

    public function destroy(string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $siswa = Siswa::findOrFail($id);

        $nama = $siswa->nama_siswa;
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', "Siswa \"{$nama}\" berhasil dihapus.");
    }
}
