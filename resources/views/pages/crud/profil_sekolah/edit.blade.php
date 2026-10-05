@extends('layouts.app')

@section('title', 'Edit Profil Sekolah')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Profil Sekolah', 'url' => route('profil_sekolah.index')],
            ['label' => 'Edit'],
        ]" />

        <div class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Profil Sekolah</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Perbarui informasi profil sekolah.
                </p>
            </div>

            <x-ui.button href="{{ route('profil_sekolah.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                Kembali
            </x-ui.button>
        </div>

        <form action="{{ route('profil_sekolah.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-ui.card>
                <h3 class="mb-5 text-base font-semibold text-gray-800 dark:text-white/90">Data Utama</h3>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.input
                        name="nama_sekolah"
                        label="Nama Sekolah"
                        placeholder="Masukan Nama Sekolah"
                        :value="old('nama_sekolah', $profil?->nama_sekolah)"
                        startIcon="file-text"
                        required
                    />

                    <x-ui.input
                        name="kepala_sekolah"
                        label="Kepala Sekolah"
                        placeholder="Nama kepala sekolah"
                        :value="old('kepala_sekolah', $profil?->kepala_sekolah)"
                        startIcon="user"
                        required
                    />

                    <x-ui.input
                        name="npsn"
                        label="NPSN"
                        placeholder="10 digit NPSN"
                        inputmode="numeric"
                        :value="old('npsn', $profil?->npsn)"
                        startIcon="file"
                        required
                    />

                    <x-ui.input
                        name="kontak"
                        label="Kontak"
                        placeholder="Nomor telepon sekolah"
                        inputmode="numeric"
                        :value="old('kontak', $profil?->kontak)"
                        startIcon="phone"
                        required
                    />

                    <x-ui.date-picker
                        name="tahun_berdiri"
                        label="Tahun Berdiri"
                        placeholder="Pilih tahun"
                        type="year"
                        :value="old('tahun_berdiri', $profil?->tahun_berdiri)"
                        required
                    />

                    <div></div> {{-- spacer --}}

                </div>
            </x-ui.card>

            {{-- ==================== KONTEN ==================== --}}
            <x-ui.card class="mt-5">
                <h3 class="mb-5 text-base font-semibold text-gray-800 dark:text-white/90">Konten</h3>

                <div class="grid grid-cols-1 gap-5">

                    <x-ui.textarea
                        name="visi_misi"
                        label="Visi & Misi"
                        placeholder="Tulis visi & misi sekolah..."
                        :value="old('visi_misi', $profil?->visi_misi)"
                        rows="5"
                        required
                    />

                    <x-ui.textarea
                        name="alamat"
                        label="Alamat"
                        placeholder="Alamat lengkap sekolah..."
                        :value="old('alamat', $profil?->alamat)"
                        rows="3"
                        required
                    />

                    <x-ui.textarea
                        name="deskripsi"
                        label="Deskripsi"
                        placeholder="Deskripsi singkat tentang sekolah..."
                        :value="old('deskripsi', $profil?->deskripsi)"
                        rows="4"
                        required
                    />

                </div>
            </x-ui.card>

            {{-- ==================== MEDIA ==================== --}}
            <x-ui.card class="mt-5">
                <h3 class="mb-5 text-base font-semibold text-gray-800 dark:text-white/90">Media</h3>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.file-input
                        name="foto"
                        label="Foto Sekolah"
                        accept="image/jpg,image/jpeg,image/png,image/webp"
                        :preview="$profil?->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($profil->foto)
                            ? asset('storage/' . $profil->foto)
                            : null"
                        hint="Kosongkan jika tidak ingin mengganti. Format: jpg, jpeg, png, webp. Maks 2MB."
                    />

                    <x-ui.file-input
                        name="logo"
                        label="Logo Sekolah"
                        accept="image/jpg,image/jpeg,image/png,image/webp,image/svg+xml"
                        :preview="$profil?->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($profil->logo)
                            ? asset('storage/' . $profil->logo)
                            : null"
                        hint="Kosongkan jika tidak ingin mengganti. Format: jpg, jpeg, png, webp, svg. Maks 1MB."
                    />

                </div>
            </x-ui.card>

            {{-- ==================== ACTION ==================== --}}
            <div class="mt-5 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <x-ui.button href="{{ route('profil_sekolah.index') }}" variant="outline" class="!w-auto">
                    Batal
                </x-ui.button>

                <x-ui.button type="submit" variant="primary"  class="!w-auto">
                    Simpan Perubahan
                </x-ui.button>
            </div>
        </form>

    </div>
@endsection