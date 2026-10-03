@extends('layouts.app')

@section('title', 'Profil Sekolah')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[['label' => 'Profil Sekolah']]" />

        {{-- HEADER --}}
        <div class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Profil Sekolah</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Informasi profil sekolah.</p>
            </div>

            <x-ui.button href="{{ route('profil_sekolah.edit') }}" startIcon="edit" class="!w-auto shrink-0">
                Edit Profil
            </x-ui.button>
        </div>

        @if (!$profil)
            {{-- Belum ada data --}}
            <x-ui.card>
                <x-ui.empty-state icon="file" title="Belum Ada Profil Sekolah"
                    message="Silakan isi profil sekolah terlebih dahulu."
                    actionLabel="Isi Profil Sekolah"
                    actionHref="{{ route('profil_sekolah.edit') }}" />
            </x-ui.card>

        @else
            {{-- HERO CARD: Logo + Nama Sekolah --}}
            <x-ui.card :padding="false">
                <div class="p-5 sm:p-6">
                    <div class="flex flex-col items-center gap-5 sm:flex-row sm:items-center">

                        {{-- Logo --}}
                        <div class="shrink-0">
                            @if($profil->logo && Storage::disk('public')->exists($profil->logo))
                                <img src="{{ asset('storage/' . $profil->logo) }}"
                                     alt="Logo {{ $profil->nama_sekolah }}"
                                     class="h-24 w-24 rounded-2xl object-contain ring-4 ring-gray-100 dark:ring-gray-700">
                            @else
                                <div class="flex h-24 w-24 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-500 text-2xl font-bold text-white">
                                    {{ strtoupper(substr($profil->nama_sekolah, 0, 2)) }}
                                </div>
                            @endif
                        </div>

                        {{-- Info Utama --}}
                        <div class="min-w-0 flex-1 text-center sm:text-left">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
                                {{ $profil->nama_sekolah }}
                            </h2>

                            <div class="mt-2 flex flex-wrap items-center justify-center gap-3 sm:justify-start">
                                <span class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400">
                                    <svg class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    Kepala Sekolah: <strong class="font-medium text-gray-700 dark:text-gray-300">{{ $profil->kepala_sekolah }}</strong>
                                </span>

                                <span class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400">
                                    <svg class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    NPSN: <strong class="font-medium text-gray-700 dark:text-gray-300">{{ $profil->npsn }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ui.card>

            {{-- INFO GRID --}}
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">

                {{-- Kolom Kiri (2/3) --}}
                <div class="space-y-5 lg:col-span-2">

                    {{-- Visi & Misi --}}
                    <x-ui.card>
                        <div class="flex items-center gap-2 mb-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 3a15 15 0 0 1 4 9 15 15 0 0 1-4 9 15 15 0 0 1-4-9 15 15 0 0 1 4-9z"/>
                                    <path d="M3 12h18"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Visi & Misi</h3>
                        </div>
                        <div class="prose prose-sm max-w-none text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            {!! nl2br(e($profil->visi_misi)) !!}
                        </div>
                    </x-ui.card>

                    {{-- Deskripsi --}}
                    <x-ui.card>
                        <div class="flex items-center gap-2 mb-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 6h16M4 12h16M4 18h10" />
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Deskripsi</h3>
                        </div>
                        <div class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            {!! nl2br(e($profil->deskripsi)) !!}
                        </div>
                    </x-ui.card>

                    {{-- Foto Sekolah --}}
                    @if($profil->foto && Storage::disk('public')->exists($profil->foto))
                        <x-ui.card :padding="false">
                            <div class="p-3">
                                <img src="{{ asset('storage/' . $profil->foto) }}"
                                     alt="Foto {{ $profil->nama_sekolah }}"
                                     class="aspect-video w-full rounded-xl object-cover">
                            </div>
                        </x-ui.card>
                    @endif
                </div>

                <div class="space-y-5">

                    <x-ui.card>
                        <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Informasi</h3>

                        <dl class="space-y-4">

                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">NPSN</dt>
                                <dd class="mt-1 font-mono text-sm text-gray-800 dark:text-gray-200">{{ $profil->npsn }}</dd>
                            </div>

                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Tahun Berdiri</dt>
                                <dd class="mt-1 text-sm text-gray-800 dark:text-gray-200">{{ $profil->tahun_berdiri }}</dd>
                            </div>

                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Kontak</dt>
                                <dd class="mt-1 text-sm text-gray-800 dark:text-gray-200">{{ $profil->kontak }}</dd>
                            </div>

                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Alamat</dt>
                                <dd class="mt-1 text-sm leading-relaxed text-gray-800 dark:text-gray-200">
                                    {!! nl2br(e($profil->alamat)) !!}
                                </dd>
                            </div>

                        </dl>
                    </x-ui.card>

                </div>
            </div>
        @endif

    </div>
@endsection