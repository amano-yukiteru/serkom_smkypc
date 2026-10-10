<?php

namespace App\Http\Controllers;

use App\Http\Requests\Jurusan\StoreJurusanRequest;
use App\Http\Requests\Jurusan\UpdateJurusanRequest;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    /**
     * ============================================
     * LIST + SEARCH + PAGINATION
     * URL: /jurusan
     * Route: jurusan.index
     * ============================================
     */
    public function index(Request $request)
    {
        $jurusans = Jurusan::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($sub) use ($search) {
                    $sub->where('nama', 'like', "%{$search}%")
                        ->orWhere('singkatan', 'like', "%{$search}%");
                });
            })
            // ->withCount('siswas')          // hitung jumlah siswa per jurusan
            ->latest('id')
            ->paginate(9)
            ->withQueryString();           // search tetap kebawa saat pindah page

        return view('pages.crud.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('pages.crud.jurusan.create');
    }

    public function store(StoreJurusanRequest $request)
    {
        $data = $request->validated();


        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('jurusan', 'public');
        }

        Jurusan::create($data);

        return redirect()
            ->route('jurusan.index')
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        // $jurusan = Jurusan::withCount('siswas')->findOrFail(Crypt::decrypt($id));

        // return view('pages.crud.jurusan.show', compact('jurusan'));
    }


    public function edit(string $id)
    {
         try {
            $id = Crypt::decrypt($id);
            $jurusan = Jurusan::findOrFail($id);
        //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('jurusan.index')->with('error', 'data tidak ditemukan');
        }

        return view('pages.crud.jurusan.edit', compact('jurusan'));
    }


    public function update(UpdateJurusanRequest $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);
            $jurusan = Jurusan::findOrFail($id);
        //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('jurusan.index')->with('error', 'data tidak ditemukan');
        }
        
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo)) {
                Storage::disk('public')->delete($jurusan->logo);
            }

            $data['logo'] = $request->file('logo')->store('jurusan', 'public');
        }

        $jurusan->update($data);

        return redirect()
            ->route('jurusan.index')
            ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
         try {
            $id = Crypt::decrypt($id);
            $jurusan = Jurusan::findOrFail($id);
        //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('jurusan.index')->with('error', 'data tidak ditemukan');
        }

        // Hapus file logo dari storage
        if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo)) {
            Storage::disk('public')->delete($jurusan->logo);
        }

        $jurusan->delete();

        return redirect()
            ->route('jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus.');
    }
}