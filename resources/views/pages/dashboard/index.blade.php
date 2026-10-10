@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-5">

        {{-- <x-ui.breadcrumb :items="[['label' => 'Dashboard']]" /> --}}

        {{-- ================= HEADER ================= --}}
        {{-- BANNER SELAMAT DATANG --}}
        <div class="flex items-center justify-between gap-4 rounded-2xl bg-gradient-to-br from-[#0f0194] via-[#0025c9] to-[#1E90D6] px-10 py-15 opacity-90 dark:from-[#02000f] dark:via-[#220965] dark:to-[#000000]">
            <div class="min-w-0">
                <h1 class="text-4xl font-bold text-white/90">
                    Selamat Datang <strong class="font-bold">{{ auth()->user()->name }}</strong>
                </h1>
                <p class="mt-1 text-base text-gray-300">
                    Ringkasan data sekolah hari ini, {{ now()->translatedFormat('d F Y') }}.
                </p>
            </div>
        </div>

        {{-- ================= STATISTIK ================= --}}
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

            <x-ui.card>
                <p class="text-sm text-gray-500 dark:text-gray-400">Berita</p>
                <p class="mt-1 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $totalBerita }}</p>
            </x-ui.card>

            <x-ui.card>
                <p class="text-sm text-gray-500 dark:text-gray-400">Guru</p>
                <p class="mt-1 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $totalGuru }}</p>
            </x-ui.card>

            <x-ui.card>
                <p class="text-sm text-gray-500 dark:text-gray-400">Siswa</p>
                <p class="mt-1 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $totalSiswa }}</p>
            </x-ui.card>

            <x-ui.card>
                <p class="text-sm text-gray-500 dark:text-gray-400">Galeri</p>
                <p class="mt-1 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $totalGaleri }}</p>
            </x-ui.card>

            <x-ui.card>
                <p class="text-sm text-gray-500 dark:text-gray-400">Ekstrakurikuler</p>
                <p class="mt-1 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $totalEkstrakurikuler }}</p>
            </x-ui.card>

            <x-ui.card>
                <p class="text-sm text-gray-500 dark:text-gray-400">Jurusan</p>
                <p class="mt-1 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $totalJurusan }}</p>
            </x-ui.card>

            <x-ui.card>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kerjasama</p>
                <p class="mt-1 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $totalKerjasama }}</p>
            </x-ui.card>

            <x-ui.card>
                <p class="text-sm text-gray-500 dark:text-gray-400">User</p>
                <p class="mt-1 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $totalUser }}</p>
            </x-ui.card>

        </div>

        {{-- ================= BERITA ================= --}}
<x-ui.card>
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">Berita Terbaru</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400">Total: {{ $totalBerita }} berita</p>
        </div>
        <a href="{{ route('berita.index') }}" class="text-sm text-blue-600 hover:underline">Lihat semua</a>
    </div>

    @if ($beritas->isEmpty())
        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada berita.</p>
    @else
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($beritas as $item)
                <x-ui.news-card
                    :image="$item->gambar && Storage::disk('public')->exists($item->gambar)
                        ? asset('storage/' . $item->gambar)
                        : null"
                    :title="$item->judul"
                    :excerpt="Str::limit(strip_tags($item->isi), 120)"
                    :date="\Carbon\Carbon::parse($item->tanggal)->format('d M Y')"
                />
            @endforeach
        </div>
    @endif
</x-ui.card>

@endsection