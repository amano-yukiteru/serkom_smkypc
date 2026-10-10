@extends('layouts.app')

@section('title', 'Tambah Kerjasama')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Kerjasama', 'url' => route('kerjasama.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-ui.card :padding="false">
            <div class="flex items-center justify-between gap-4 px-5 py-4">
                <div class="min-w-0">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Tambah Kerjasama</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Isi form di bawah untuk menambahkan data kerjasama baru.
                    </p>
                </div>

                <x-ui.button href="{{ route('kerjasama.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                    Kembali
                </x-ui.button>
            </div>
        </x-ui.card>

        <form action="{{ route('kerjasama.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 ">

                    <x-ui.input
                        name="nama_perusahaan"
                        label="Nama Perusahaan"
                        placeholder="Nama perusahaan"
                        :value="old('nama_perusahaan')"
                        startIcon="building"
                        required
                    />

                    {{-- <x-ui.input
                        name="kategori"
                        label="Kategori"
                        placeholder="MoU / MoA / PKS"
                        :value="old('kategori')"
                        startIcon="tag"
                        required
                    /> --}}

                    <div class="md:col-span-2">
                        <x-ui.file-input
                            name="foto"
                            label="Foto / Logo Perusahaan"
                            accept="image/jpeg,image/png,image/webp"
                            hint="Format: jpg, jpeg, png, webp. Maks 2MB."
                            required
                        />
                    </div>

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button href="{{ route('kerjasama.index') }}" variant="outline" class="!w-auto">
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