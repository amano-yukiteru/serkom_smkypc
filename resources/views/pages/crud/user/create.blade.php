@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb
            :items="[
                ['label' => 'User', 'url' => route('user.index')],
                ['label' => 'Tambah']
            ]"
        />

        <div class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Tambah User</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Isi form di bawah untuk menambahkan user baru.
                </p>
            </div>

            <x-ui.button href="{{ route('user.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                Kembali
            </x-ui.button>
        </div>

        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.input 
                        name="name" 
                        label="Nama" 
                        placeholder="Nama lengkap" 
                        :value="old('name')" 
                        startIcon="user"
                        required />

                    <x-ui.input 
                        name="username" 
                        label="Username" 
                        placeholder="Username untuk login" 
                        :value="old('username')"
                        startIcon="user" 
                        required />

                    <x-ui.select 
                        name="role" 
                        label="Role" 
                        placeholder="Pilih role" 
                        :value="old('role')" 
                        :options="['Admin' => 'Admin', 'Oprator' => 'Oprator']"
                        required />

                    <x-ui.input 
                        name="password" 
                        label="Password" 
                        type="password" 
                        placeholder="Minimal 8 karakter"
                        required />
{{-- 
                    <x-ui.input 
                        name="password_confirmation" 
                        label="Konfirmasi Password" 
                        type="password"
                        placeholder="Ulangi password" 
                        required /> --}}

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
                        Simpan
                    </x-ui.button>
                </div>
            </x-ui.card>
        </form>

    </div>
@endsection
