@extends('layouts.app')

@section('title', 'Dashboard')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="space-y-5">

        {{-- BANNER SELAMAT DATANG --}}
        <div class="flex items-center justify-between gap-4 rounded-2xl bg-gradient-to-br from-[#0f0194] via-[#0025c9] to-[#1E90D6] px-10 py-15 opacity-90 dark:from-[#02000f] dark:via-[#1d295c] dark:to-[#000000]">
            <div class="min-w-0">
                <h1 class="text-4xl font-bold text-white/90">
                    Selamat Datang <strong class="font-bold">{{ auth()->user()->name }}</strong>
                </h1>
                <p class="mt-1 text-base text-gray-300">
                    Ringkasan data sekolah hari ini, {{ now()->translatedFormat('d F Y') }}.
                </p>
            </div>
        </div>

        {{-- STAT CARDS --}}
        <x-ui.stat-grid :cols="4">

            <x-ui.stat-card
                size="lg"
                label="Total Siswa"
                color="blue"
                :value="number_format($totalSiswa ?? 0)"
            />

            <x-ui.stat-card
                size="lg"
                color="purple"
                label="Total Guru"
                :value="number_format($totalGuru ?? 0)"
            />

            <x-ui.stat-card
                size="lg"
                label="Total Berita"
                :value="number_format($totalBerita ?? 0)"
                color="amber"
            />

            <x-ui.stat-card
                size="lg"
                label="Total Eskul"
                color="emerald"
                :value="number_format($totalEskul ?? 0)"
            />

        </x-ui.stat-grid>

        {{-- BERITA TERBARU --}}
        <x-ui.card :padding="false">
            <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4 dark:border-gray-700">
                <div>
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white/90">Berita Terbaru</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Berita yang baru ditambahkan</p>
                </div>
            </div>

            <div class="p-5">
                @if ($beritaTerbaru->isEmpty())
                    <x-ui.empty-state
                        icon="file"
                        title="Belum Ada Berita"
                        message="Tambahkan berita untuk memulai."
                        actionLabel="Tulis Berita"
                        actionHref="{{ route('berita.create') }}"
                    />
                @else
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($beritaTerbaru as $item)
                            <x-ui.news-card
                                :image="$item->gambar && Storage::disk('public')->exists($item->gambar)
                                    ? asset('storage/' . $item->gambar)
                                    : null"
                                :title="$item->judul"
                                :excerpt="Str::limit(strip_tags($item->isi), 80)"
                                :date="$item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') : null"
                                :author="$item->user?->name ?? 'Anonim'"
                                :editHref="route('berita.edit', Crypt::encrypt($item->id))"
                            />
                        @endforeach
                    </div>
                @endif
            </div>
        </x-ui.card>

    </div>
@endsection