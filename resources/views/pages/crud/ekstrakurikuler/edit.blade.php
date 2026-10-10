@extends('layouts.app')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Ekstrakurikuler', 'url' => route('ekstrakurikuler.index')],
            ['label' => 'Edit'],
        ]" />
        <x-ui.card :padding="false">
        <div class="flex items-center justify-between gap-4 px-5 py-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Ekstrakurikuler</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Ubah ekstrakurikuler
                    <strong class="text-gray-800 dark:text-white/90">{{ $eskul->nama_eskul }}</strong>.
                </p>
            </div>
                <x-ui.button href="{{ route('ekstrakurikuler.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                    Kembali
                </x-ui.button>
        </div>
        </x-ui.card>

        {{-- </div> --}}

        <form action="{{ route('ekstrakurikuler.update', $encryptedId = Crypt::encrypt($eskul->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.input
                        name="nama_eskul"
                        label="Nama Ekstrakurikuler"
                        placeholder="Nama eskul"
                        :value="old('nama_eskul', $eskul->nama_eskul)"
                        startIcon="file"
                        required
                    />

                    <x-ui.input
                        name="pembina"
                        label="Pembina"
                        placeholder="Nama pembina"
                        :value="old('pembina', $eskul->pembina)"
                        startIcon="user"
                        required
                    />

                    {{-- Hari saja --}}
                    <div class="md:col-span-2">
                        <x-ui.select
                            name="jadwal_latihan"
                            label="Hari Latihan"
                            placeholder="Pilih hari"
                            :value="old('jadwal_latihan', $eskul->jadwal_latihan)"
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
                            :value="old('deskripsi', $eskul->deskripsi)"
                            rows="5"
                            required
                        />
                    </div>

                    <div class="md:col-span-2">
                        <x-ui.file-input
                            name="foto"
                            label="Foto Ekstrakurikuler"
                            accept="image/jpeg,image/png,image/webp"
                            :preview="$eskul->foto ? asset('storage/' . $eskul->foto) : null"
                            hint="Kosongkan jika tidak ingin mengganti foto. Maks 2MB."
                        />
                    </div>

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button href="{{ route('ekstrakurikuler.index') }}" variant="outline" class="!w-auto">
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