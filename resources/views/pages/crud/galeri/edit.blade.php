@extends('layouts.app')

@section('title', 'Edit Galeri')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Galeri', 'url' => route('galeri.index')],
            ['label' => 'Edit'],
        ]" />

        <div class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Galeri</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Perbarui data galeri di bawah ini.
                </p>
            </div>

            <x-ui.button href="{{ route('galeri.index') }}" variant="outline" startIcon="arrow-left" class="!w-auto shrink-0">
                Kembali
            </x-ui.button>
        </div>

        <form action="{{ route('galeri.update', Crypt::encrypt($galeri->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5">

                    {{-- Preview file lama --}}
                    @if ($galeri->file)
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                File Saat Ini
                            </p>

                            @if ($galeri->kategori === 'Video')
                                <video controls class="w-full max-w-md rounded-lg border border-gray-200 dark:border-gray-700">
                                    <source src="{{ Storage::url($galeri->file) }}">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                            @else
                                <img
                                    src="{{ Storage::url($galeri->file) }}"
                                    alt="{{ $galeri->judul }}"
                                    class="w-full max-w-md rounded-lg border border-gray-200 dark:border-gray-700"
                                >
                            @endif

                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Kategori: <span class="font-medium">{{ $galeri->kategori }}</span>
                            </p>
                        </div>
                    @endif

                    <x-ui.input
                        name="judul"
                        label="Judul"
                        placeholder="Contoh: Kegiatan Pramuka 2024"
                        :value="old('judul', $galeri->judul)"
                        startIcon="file"
                        required
                    />

                    <x-ui.textarea
                        name="keterangan"
                        label="Keterangan"
                        placeholder="Keterangan galeri..."
                        :value="old('keterangan', $galeri->keterangan)"
                        rows="5"
                        required
                    />

                    <x-ui.file-input
                        name="file"
                        label="Ganti File (opsional)"
                        accept="image/jpeg,image/png,image/webp,video/mp4,video/webm,video/quicktime"
                        hint="Biarkan kosong jika tidak ingin mengganti file. Format: jpg, jpeg, png, webp, mp4, webm, mov. Maks 10MB."
                    />

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button href="{{ route('galeri.index') }}" variant="outline" class="!w-auto">
                        Batal
                    </x-ui.button>

                    <x-ui.button type="submit" variant="primary" startIcon="save" class="!w-auto">
                        Perbarui
                    </x-ui.button>
                </div>
            </x-ui.card>
        </form>

    </div>
@endsection