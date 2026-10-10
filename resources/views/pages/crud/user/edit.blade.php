@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[['label' => 'User', 'url' => route('user.index')], ['label' => 'Edit']]" />

        <x-ui.card :padding="false">
        <div class="flex items-center justify-between gap-4 px-5 py-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Edit User</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Ubah data user
                    <strong class="text-gray-800 dark:text-white/90">{{ $user->name }}</strong>.
                </p>
            </div>

            <x-ui.button href="{{ route('user.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                Kembali
            </x-ui.button>
        </div>
        </x-ui.card>

        <form action="{{ route('user.update', Crypt::encrypt($user->id)) }}" method="POST">
            @csrf
            @method('PUT')

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.input 
                        name="name" 
                        label="Nama" 
                        placeholder="Nama lengkap"
                        :value="old('name', $user->name)" 
                        startIcon="user" 
                        required />

                    <x-ui.input 
                        name="username" 
                        label="Username" 
                        placeholder="Username untuk login"
                        :value="old('username', $user->username)" 
                        startIcon="user" 
                        required />

                    @if (Auth::user()->role != $user->role)
                        <x-ui.select 
                        name="role" 
                        label="Role" 
                        placeholder="Pilih role"
                        :value="old('role', $user->role)"
                        :options="['Admin' => 'Admin', 'Oprator' => 'Oprator']"
                        required />
                    @endif

                    <x-ui.input 
                        name="password" 
                        label="Password Baru"
                        type="password"
                        placeholder="Kosongkan jika tidak diubah"/>

                    {{-- <x-ui.input 
                        name="password_confirmation" label="Konfirmasi Password" 
                        type="password"
                        placeholder="Ulangi password baru" /> --}}

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button 
                        href="{{ route('user.index') }}" 
                        variant="outline" 
                        class="!w-auto">
                        Batal
                    </x-ui.button>

                    <x-ui.button 
                        type="submit" 
                        variant="primary" 
                        startIcon="save" 
                        class="!w-auto">
                        Simpan Perubahan
                    </x-ui.button>
                </div>
            </x-ui.card>
        </form>

    </div>
@endsection