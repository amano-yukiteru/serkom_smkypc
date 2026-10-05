@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
    <div class="space-y-5">

        {{-- BREADCRUMB --}}
        <x-ui.breadcrumb :items="[
            ['label' => 'Siswa', 'url' => route('siswa.index')],
            ['label' => 'Edit'],
        ]" />

        {{-- HEADER --}}
        <div class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Edit Siswa
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Ubah data siswa
                    <strong class="text-gray-800 dark:text-white/90">{{ $siswa->nama_siswa }}</strong>.
                </p>
            </div>

            <x-ui.button
                href="{{ route('siswa.index') }}"
                variant="outline"
                startIcon="arrow-left"
                class="!w-auto shrink-0"
            >
                Kembali
            </x-ui.button>
        </div>

        {{-- FORM --}}
        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.input
                        name="nisn"
                        label="NISN"
                        placeholder="Masukkan NISN"
                        inputmode="numeric"
                        :value="old('nisn', $siswa->nisn)"
                        required
                    />

                    <x-ui.input
                        name="nama_siswa"
                        label="Nama Siswa"
                        placeholder="Nama lengkap siswa"
                        :value="old('nama_siswa', $siswa->nama_siswa)"
                        required
                    />

                    <x-ui.select
                        name="jenis"
                        label="Jenis Kelamin"
                        placeholder="Pilih jenis kelamin"
                        :value="old('jenis', $siswa->jenis)"
                        :options="['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan']"
                        required
                    />

                    <x-ui.date-picker
                        name="tahun_masuk"
                        label="Tahun Masuk"
                        type="year"
                        :value="old('tahun_masuk', $siswa->tahun_masuk)"
                        required
                    />

                </div>

                {{-- ACTION BUTTONS --}}
                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button
                        href="{{ route('siswa.index') }}"
                        variant="outline"
                        class="!w-auto"
                    >
                        Batal
                    </x-ui.button>

                    <x-ui.button
                        type="submit"
                        variant="primary"
                        startIcon="save"
                        class="!w-auto"
                    >
                        Simpan Perubahan
                    </x-ui.button>
                </div>
            </x-ui.card>
        </form>

    </div>
@endsection