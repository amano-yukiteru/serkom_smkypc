<?php

namespace App\Http\Controllers;

use App\Http\Requests\Siswa\StoreSiswaRequest;
use App\Http\Requests\Siswa\UpdateSiswaRequest;
use App\Models\Siswa;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $siswa = Siswa::query()
            ->when($search, fn ($q) => $q->whereAny(
                ['nama_siswa', 'nisn'],
                'like',
                "%{$search}%"
            ))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pages.crud.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('pages.crud.siswa.create');
    }

    public function store(StoreSiswaRequest $request)
    {
        Siswa::create($request->validated());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $siswa = Siswa::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('siswa.index')->with('error', 'data tidak ditemukan');
        }
        // $siswa = $this->findByEncryptedId($encryptedId);

        return view('pages.crud.siswa.edit', compact('siswa'));
    }

    public function update(UpdateSiswaRequest $request, string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $siswa = Siswa::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('siswa.index')->with('error', 'data tidak ditemukan');
        }
        
        // $siswa = $this->findByEncryptedId($encryptedId);
        $siswa->update($request->validated());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(string $encryptedId)
    {
        // $siswa = $this->findByEncryptedId($encryptedId);
         try {
            $id = Crypt::decrypt($encryptedId);
            $siswa = Siswa::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('siswa.index')->with('error', 'data tidak ditemukan');
        }
        $nama  = $siswa->nama_siswa;
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa "'.$nama.'" berhasil dihapus.');
    }

}