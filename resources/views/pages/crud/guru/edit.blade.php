@extends('layouts.app')

@section('title', 'Edit Guru')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Guru', 'url' => route('guru.index')],
            ['label' => 'Edit'],
        ]" />

        <x-ui.card :padding="false">
            <div class="flex items-center justify-between gap-4 px-5 py-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Guru</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Ubah data guru
                    <strong class="text-gray-800 dark:text-white/90">{{ $guru->nama_guru }}</strong>.
                </p>
            </div>

            <x-ui.button href="{{ route('guru.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                Kembali
            </x-ui.button>
        </div>
        </x-ui.card>

        <form action="{{ route('guru.update', Crypt::encrypt($guru->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.input
                        name="nama_guru"
                        label="Nama Guru"
                        placeholder="Nama lengkap guru"
                        :value="old('nama_guru', $guru->nama_guru)"
                        startIcon="user"
                        required
                    />

                    <x-ui.input
                        name="nip"
                        label="NIP"
                        placeholder="18 digit NIP"
                        inputmode="numeric"
                        :value="old('nip', $guru->nip)"
                        startIcon="file-text"
                        required
                    />

                    <x-ui.input
                        name="mapel"
                        label="Mata Pelajaran"
                        placeholder="Matematika"
                        :value="old('mapel', $guru->mapel)"
                        startIcon="file"
                        required
                    />

                    <div></div> {{-- spacer --}}

                    <div class="md:col-span-2">
                        <x-ui.file-input
                            name="foto"
                            label="Foto Guru"
                            accept="image/jpg,image/jpeg,image/png,image/webp"
                            :preview="$guru->foto ? asset('storage/' . $guru->foto) : null"
                            hint="Kosongkan jika tidak ingin mengganti foto. Maks 2MB."
                        />
                    </div>

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button href="{{ route('guru.index') }}" variant="outline" class="!w-auto">
                        Batal
                    </x-ui.button>

                    <x-ui.button type="submit" variant="primary" startIcon="save" class="!w-auto">
                        Simpan Perubahan
                    </x-ui.button>
                </div>
            </x-ui.card>
        </form>

    </div>
@endsection