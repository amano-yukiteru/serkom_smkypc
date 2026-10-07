@extends('layouts.app')

@section('title', 'Tambah Galeri')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Galeri', 'url' => route('galeri.index')],
            ['label' => 'Tambah'],
        ]" />

        <div class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Tambah Galeri</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Isi form di bawah untuk menambahkan galeri baru.
                </p>
            </div>

            <x-ui.button href="{{ route('galeri.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                Kembali
            </x-ui.button>
        </div>

        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5">

                    <x-ui.input
                        name="judul"
                        label="Judul"
                        placeholder="Contoh: Kegiatan Pramuka 2024"
                        :value="old('judul')"
                        startIcon="file"
                        required
                    />

                    <x-ui.textarea
                        name="keterangan"
                        label="Keterangan"
                        placeholder="Keterangan galeri..."
                        :value="old('keterangan')"
                        rows="5"
                        required
                    />

                    <x-ui.file-input
                        name="file"
                        label="File Galeri"
                        accept="image/jpeg,image/png,image/webp,video/mp4,video/webm,video/quicktime"
                        hint="Format: jpg, jpeg, png, webp, mp4, webm, mov. Maks 10MB. Kategori (Foto/Video) otomatis."
                        required
                    />

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button href="{{ route('galeri.index') }}" variant="outline" class="!w-auto">
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