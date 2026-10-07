@extends('layouts.app')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Ekstrakurikuler', 'url' => route('ekstrakurikuler.index')],
            ['label' => 'Tambah'],
        ]" />

        <div class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Tambah Ekstrakurikuler</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Isi form di bawah untuk menambahkan ekstrakurikuler baru.
                </p>
            </div>

            <x-ui.button href="{{ route('ekstrakurikuler.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                Kembali
            </x-ui.button>
        </div>

        <form action="{{ route('ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.input
                        name="nama_eskul"
                        label="Nama Ekstrakurikuler"
                        placeholder="Pramuka, Paskibra"
                        :value="old('nama_eskul')"
                        startIcon="file"
                        required
                    />

                    <x-ui.input
                        name="pembina"
                        label="Pembina"
                        placeholder="Nama pembina"
                        :value="old('pembina')"
                        startIcon="user"
                        required
                    />

                    {{-- Hari saja --}}
                    <div class="md:col-span-2">
                        <x-ui.select
                            name="hari"
                            label="Hari Latihan"
                            placeholder="Pilih hari"
                            :value="old('hari')"
                            :options="[
                                'Senin'  => 'Senin',
                                'Selasa' => 'Selasa',
                                'Rabu'   => 'Rabu',
                                'Kamis'  => 'Kamis',
                                'Jumat'  => 'Jumat',
                                'Sabtu'  => 'Sabtu',
                                'Minggu' => 'Minggu',
                            ]"
                            required
                        />
                    </div>

                    <div class="md:col-span-2">
                        <x-ui.textarea
                            name="deskripsi"
                            label="Deskripsi"
                            placeholder="Deskripsi ekstrakurikuler..."
                            :value="old('deskripsi')"
                            rows="5"
                            required
                        />
                    </div>

                    <div class="md:col-span-2">
                        <x-ui.file-input
                            name="foto"
                            label="Foto Ekstrakurikuler"
                            accept="image/jpeg,image/png,image/webp"
                            hint="Format: jpg, jpeg, png, webp. Maks 2MB."
                            required
                        />
                    </div>

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button href="{{ route('ekstrakurikuler.index') }}" variant="outline" class="!w-auto">
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