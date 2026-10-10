@extends('layouts.app')

@section('title', 'Tambah Jurusan')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Jurusan', 'url' => route('jurusan.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-ui.card :padding="false">
        <div class="flex items-center justify-between gap-4 px-5 py-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Tambah Jurusan</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Isi form di bawah untuk menambahkan jurusan baru.
                </p>
            </div>

            <x-ui.button href="{{ route('jurusan.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                Kembali
            </x-ui.button>
        </div>
        </x-ui.card>

        <form action="{{ route('jurusan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.input
                        name="nama"
                        label="Nama Jurusan"
                        placeholder="Nama jurusan"
                        :value="old('nama')"
                        startIcon="file"
                        required
                    />

                    <x-ui.input
                        name="singkatan"
                        label="Singkatan"
                        placeholder="TKJ"
                        :value="old('singkatan')"
                        startIcon="tag"
                        required
                    />

                    <div class="md:col-span-2">
                        <x-ui.textarea
                            name="deskripsi"
                            label="Deskripsi"
                            placeholder="Deskripsi jurusan..."
                            :value="old('deskripsi')"
                            rows="5"
                            required
                        />
                    </div>

                    <div class="md:col-span-2">
                        <x-ui.file-input
                            name="logo"
                            label="Logo Jurusan"
                            accept="image/jpeg,image/png,image/webp"
                            hint="Format: jpg, jpeg, png, webp. Maks 2MB."
                            required
                        />
                    </div>

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button href="{{ route('jurusan.index') }}" variant="outline" class="!w-auto">
                        Batal
                    </x-ui.button>

                    <x-ui.button type="submit" variant="primary" startIcon="save" class="!w-auto">
                        Simpan
                    </x-ui.button>
                </div>
            </x-ui.card>
        </form>

    </div>
@endsection