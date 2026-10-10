@extends('layouts.app')

@section('title', 'Edit Jurusan')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Jurusan', 'url' => route('jurusan.index')],
            ['label' => 'Edit'],
        ]" />

        <x-ui.card :padding="false">
        <div class="flex items-center justify-between gap-4 px-5 py-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Jurusan</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Perbarui data jurusan di bawah ini.
                </p>
            </div>

            <x-ui.button href="{{ route('jurusan.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                Kembali
            </x-ui.button>
        </div>
        </x-ui.card>

        <form action="{{ route('jurusan.update', Crypt::encrypt($jurusan->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.input
                        name="nama"
                        label="Nama Jurusan"
                        placeholder="Nama jurusan"
                        :value="old('nama', $jurusan->nama)"
                        startIcon="file"
                        required
                    />

                    <x-ui.input
                        name="singkatan"
                        label="Singkatan"
                        placeholder="TKJ"
                        :value="old('singkatan', $jurusan->singkatan)"
                        startIcon="tag"
                        required
                    />

                    <div class="md:col-span-2">
                        <x-ui.textarea
                            name="deskripsi"
                            label="Deskripsi"
                            placeholder="Deskripsi jurusan..."
                            :value="old('deskripsi', $jurusan->deskripsi)"
                            rows="5"
                            required
                        />
                    </div>

                    {{-- Logo lama --}}
                    {{-- @if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo))
                        <div class="md:col-span-2">
                            <p class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Logo Saat Ini</p>
                            <img src="{{ asset('storage/' . $jurusan->logo) }}"
                                 alt="{{ $jurusan->nama }}"
                                 class="h-24 w-24 rounded-lg object-cover border border-gray-200 dark:border-gray-700">
                        </div>
                    @endif --}}

                    <div class="md:col-span-2">
                        <x-ui.file-input
                            name="logo"
                            label="Ganti Logo (opsional)"
                            accept="image/jpeg,image/png,image/webp"
                            hint="Biarkan kosong jika tidak ingin mengganti logo."
                        />
                    </div>

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button href="{{ route('jurusan.index') }}" variant="outline" class="!w-auto">
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