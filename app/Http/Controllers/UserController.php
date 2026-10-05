<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Tampilkan daftar user dengan search, filter role, sort, dan pagination.
     */
    public function index(IndexUserRequest $request)
    {
        $validated = $request->validated();

        $search  = $validated['search']   ?? null;
        $role    = $validated['role']     ?? null;
        $sort    = $validated['sort']     ?? 'created_at';
        $order   = $validated['order']    ?? 'desc';
        $perPage = $validated['per_page'] ?? 9;

        $users = User::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('name', 'like', "%{$search}%")
                       ->orWhere('username', 'like', "%{$search}%");
                });
            })
            ->when($role, fn ($q) => $q->where('role', $role))
            ->orderBy($sort, $order)
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.crud.user.index', compact('users'));
    }

    /**
     * Form tambah user baru.
     */
    public function create()
    {
        return view('pages.crud.user.create');
    }

    /**
     * Simpan user baru ke database.
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail user.
     */
    public function show(string $encryptedId)
    {
        $user = $this->findByEncrypted($encryptedId);

        return view('pages.crud.user.show', compact('user'));
    }

    /**
     * Form edit user.
     */
    public function edit(string $encryptedId)
    {
        $user = $this->findByEncrypted($encryptedId);

        return view('pages.crud.user.edit', compact('user'));
    }

    /**
     * Update data user.
     */
    public function update(UpdateUserRequest $request, string $encryptedId)
    {
        $user = $this->findByEncrypted($encryptedId);
        $data = $request->validated();

        // Cegah ubah role dari Admin ke Oprator kalau dia satu-satunya Admin
        if (
            $user->role === 'Admin' &&
            ($data['role'] ?? null) !== 'Admin' &&
            User::where('role', 'Admin')->count() <= 1
        ) {
            return back()
                ->withInput()
                ->with('error', 'Tidak bisa mengubah role Admin terakhir. Minimal harus ada 1 Admin.');
        }

        // Kalau password kosong, jangan ubah
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus user.
     */
    public function destroy(string $encryptedId)
    {
        $user = $this->findByEncrypted($encryptedId);

        // Cegah hapus akun sendiri
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        // Cegah hapus Admin terakhir
        if (
            $user->role === 'Admin' &&
            User::where('role', 'Admin')->count() <= 1
        ) {
            return back()->with('error', 'Tidak bisa menghapus Admin terakhir. Minimal harus ada 1 Admin.');
        }

        $user->delete();

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }

    /**
     * Decrypt hash ID → cari User.
     * Kalau gagal decrypt atau user tidak ditemukan → 404.
     */
    private function findByEncrypted(string $encryptedId): User
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (\Throwable $e) {
            abort(404);
        }

        return User::findOrFail($id);
    }
}