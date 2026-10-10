@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[
            ['label' => 'Berita', 'url' => route('berita.index')],
            ['label' => 'Edit'],
        ]" />
        <x-ui.card :padding="false">
            <div class="flex items-center justify-between gap-4 px-5 py-4">
                <div class="min-w-0">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Berita</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Ubah berita
                        <strong class="text-gray-800 dark:text-white/90">{{ $berita->judul }}</strong>.
                    </p>
                </div>
                <x-ui.button href="{{ route('berita.index') }}" variant="outline" class="!w-auto shrink-0">
                    Kembali
                </x-ui.button>
            </div>
        </x-ui.card>

        <form action="{{ route('berita.update', Crypt::encrypt($berita->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-ui.card>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <x-ui.input
                        name="judul"
                        label="Judul Berita"
                        placeholder="Judul berita"
                        :value="old('judul', $berita->judul)"
                        startIcon="file-text"
                        required
                    />

                    <x-ui.date-picker
                        name="tanggal"
                        label="Tanggal"
                        type="date"
                        :value="old('tanggal', $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('Y-m-d') : null)"
                        required
                    />

                    <div class="md:col-span-2">
                        <x-ui.textarea
                            name="isi"
                            label="Isi Berita"
                            placeholder="Tulis isi berita di sini..."
                            :value="old('isi', $berita->isi)"
                            rows="6"
                            required
                        />
                    </div>

                    <div class="md:col-span-2">
                        <x-ui.file-input
                            name="gambar"
                            label="Gambar Berita"
                            accept="image/jpg,image/jpeg,image/png,image/webp"
                            :preview="$berita->gambar ? asset('storage/' . $berita->gambar) : null"
                            hint="Kosongkan jika tidak ingin mengganti gambar. Maks 2MB."
                        />
                    </div>

                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 dark:border-gray-700 sm:flex-row sm:justify-end">
                    <x-ui.button href="{{ route('berita.index') }}" variant="outline" class="!w-auto">
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