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
    public function index(IndexUserRequest $request)
    {
        $validated = $request->validated();

        $search = $validated['search'] ?? null;
        $role = $validated['role'] ?? null;
        $sort = $validated['sort'] ?? 'created_at';
        $order = $validated['order'] ?? 'desc';
        $perPage = $validated['per_page'] ?? 9;

        $users = User::query()
            ->when($search, fn ($q) => $q->whereAny(
                ['name', 'username'],
                'like',
                "%{$search}%"
            ))
            ->when($role, fn ($q) => $q->where('role', $role))
            ->orderBy($sort, $order)
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.crud.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.crud.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(string $encryptedId)
    {
        //
    }

    public function edit(string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $user = User::findOrFail($id);

        return view('pages.crud.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $user = User::findOrFail($id);
        $data = $request->validated();

        if ($user->role === 'Admin' && ($data['role'] ?? null) !== 'Admin' && User::where('role', 'Admin')->count() <= 1)
        {
            return back()->withInput()->with('error', 'Tidak bisa mengubah role Admin terakhir.');
        }

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $user = User::findOrFail($id);

        // Cegah hapus akun sendiri
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        // Cegah hapus Admin terakhir
        if ($user->role === 'Admin' && User::where('role', 'Admin')->count() <= 1) {
            return back()->with('error', 'Tidak bisa menghapus Admin terakhir.');
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
