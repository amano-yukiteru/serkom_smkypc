@extends('layouts.app')

@section('title', 'Edit Kerjasama')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Kerjasama', 'url' => route('kerjasama.index')],
            ['label' => 'Edit'],
        ]" />

        <x-ui.card :padding="false">
            <div class="flex items-center justify-between gap-4 px-5 py-4">
                <div class="min-w-0">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Kerjasama</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Perbarui data kerjasama di bawah ini.
                    </p>
                </div>

                <x-ui.button href="{{ route('kerjasama.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                    Kembali
                </x-ui.button>
            </div>
        </x-ui.card>

        <form action="{{ route('kerjasama.update',$encryptedId = Crypt::encrypt($kerjasama->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 ">

                    <x-ui.input
                        name="nama_perusahaan"
                        label="Nama Perusahaan"
                        placeholder="Nama perusahaan"
                        :value="old('nama_perusahaan', $kerjasama->nama_perusahaan)"
                        startIcon="building"
                        required
                    />

                    {{-- <x-ui.input
                        name="kategori"
                        label="Kategori"
                        placeholder="MoU / MoA / PKS"
                        :value="old('kategori', $kerjasama->kategori)"
                        startIcon="tag"
                        required
                    /> --}}

                    {{-- Foto lama --}}
                    @if ($kerjasama->foto && Storage::disk('public')->exists($kerjasama->foto))
                        <div class="md:col-span-2">
                            <p class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Foto Saat Ini</p>
                            <img src="{{ asset('storage/' . $kerjasama->foto) }}"
                                 alt="{{ $kerjasama->nama_perusahaan }}"
                                 class="h-24 w-24 rounded-lg object-cover border border-gray-200 dark:border-gray-700">
                        </div>
                    @endif

                    <div class="md:col-span-2">
                        <x-ui.file-input
                            name="foto"
                            label="Ganti Foto (opsional)"
                            accept="image/jpeg,image/png,image/webp"
                            hint="Biarkan kosong jika tidak ingin mengganti foto. Format: jpg, jpeg, png, webp. Maks 2MB."
                        />
                    </div>

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button href="{{ route('kerjasama.index') }}" variant="outline" class="!w-auto">
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