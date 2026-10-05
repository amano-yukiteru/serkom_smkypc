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

        $search  = $validated['search']   ?? null;
        $hari    = $validated['hari']     ?? null;
        $sort    = $validated['sort']     ?? 'created_at';
        $order   = $validated['order']    ?? 'desc';
        $perPage = $validated['per_page'] ?? 9;

        $eskuls = Ekstrakurikuler::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('nama_eskul', 'like', "%{$search}%")
                       ->orWhere('pembina', 'like', "%{$search}%");
                });
            })
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

        // ✅ MAPPING: 'hari' → kolom 'jadwal_latihan'
        $data['jadwal_latihan'] = $data['hari'];
        unset($data['hari']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('ekstrakurikuler/foto', 'public');
        }

        Ekstrakurikuler::create($data);

        return redirect()
            ->route('ekstrakurikuler.index')
            ->with('success', 'Data ekstrakurikuler berhasil ditambahkan.');
    }

    public function show(string $encryptedId)
    {
        // $eskul = $this->findByEncrypted($encryptedId);
        // return view('pages.crud.ekstrakurikuler.show', compact('eskul'));
    }

    public function edit(string $encryptedId)
    {
        $eskul = $this->findByEncrypted($encryptedId);

        return view('pages.crud.ekstrakurikuler.edit', compact('eskul'));
    }

    public function update(UpdateEkstrakurikulerRequest $request, string $encryptedId)
    {
        $eskul = $this->findByEncrypted($encryptedId);
        $data  = $request->validated();

        // ✅ MAPPING: 'hari' → kolom 'jadwal_latihan'
        $data['jadwal_latihan'] = $data['hari'];
        unset($data['hari']);

        if ($request->hasFile('foto')) {
            if ($eskul->foto) {
                Storage::disk('public')->delete($eskul->foto);
            }
            $data['foto'] = $request->file('foto')->store('ekstrakurikuler/foto', 'public');
        }

        $eskul->update($data);

        return redirect()
            ->route('ekstrakurikuler.index')
            ->with('success', 'Data ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(string $encryptedId)
    {
        $eskul = $this->findByEncrypted($encryptedId);

        if ($eskul->foto) {
            Storage::disk('public')->delete($eskul->foto);
        }

        $nama = $eskul->nama_eskul;
        $eskul->delete();

        return redirect()
            ->route('ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler "' . $nama . '" berhasil dihapus.');
    }

    private function findByEncrypted(string $encryptedId): Ekstrakurikuler
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (\Throwable $e) {
            abort(404);
        }

        return Ekstrakurikuler::findOrFail($id);
    }
}