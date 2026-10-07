<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ekstrakurikuler\IndexEkstrakurikulerRequest;
use App\Http\Requests\Ekstrakurikuler\StoreEkstrakurikulerRequest;
use App\Http\Requests\Ekstrakurikuler\UpdateEkstrakurikulerRequest;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    public function index(IndexEkstrakurikulerRequest $request)
    {
        $validated = $request->validated();

        $search = $validated['search'] ?? null;
        $hari = $validated['hari'] ?? null;
        $sort = $validated['sort'] ?? 'created_at';
        $order = $validated['order'] ?? 'desc';
        $perPage = $validated['per_page'] ?? 9;

        $eskuls = Ekstrakurikuler::query()
            ->when($search, fn ($q) => $q->whereAny(
                ['nama_eskul', 'pembina'],
                'like',
                "%{$search}%"
            ))
            ->when($hari, fn ($q) => $q->where('jadwal_latihan', $hari))
            ->orderBy($sort, $order)
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.crud.ekstrakurikuler.index', compact('eskuls'));
    }

    public function create()
    {
        return view('pages.crud.ekstrakurikuler.create');
    }

    public function store(StoreEkstrakurikulerRequest $request)
    {
        $data = $request->validated();

        // Mapping: 'hari' → 'jadwal_latihan'
        $data['jadwal_latihan'] = $data['hari'];
        unset($data['hari']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('ekstrakurikuler/foto', 'public');
        }

        Ekstrakurikuler::create($data);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil ditambahkan.');
    }

    public function show(string $encryptedId)
    {
        //
    }

    public function edit(string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $eskul = Ekstrakurikuler::findOrFail($id);

        return view('pages.crud.ekstrakurikuler.edit', compact('eskul'));
    }

    public function update(UpdateEkstrakurikulerRequest $request, string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $eskul = Ekstrakurikuler::findOrFail($id);
        $data = $request->validated();

        // Mapping: 'hari' → 'jadwal_latihan'
        $data['jadwal_latihan'] = $data['hari'];
        unset($data['hari']);

        if ($request->hasFile('foto')) {
            if ($eskul->foto) {
                Storage::disk('public')->delete($eskul->foto);
            }
            $data['foto'] = $request->file('foto')->store('ekstrakurikuler/foto', 'public');
        }

        $eskul->update($data);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $eskul = Ekstrakurikuler::findOrFail($id);

        if ($eskul->foto) {
            Storage::disk('public')->delete($eskul->foto);
        }

        $nama = $eskul->nama_eskul;
        $eskul->delete();

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler "'.$nama.'" berhasil dihapus.');
    }
}
