@extends('layouts.app')

@section('title', 'Profil Sekolah')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[['label' => 'Profil Sekolah']]" />

        {{-- HEADER --}}
                <x-ui.card :padding="false">
        <div class="flex items-center justify-between gap-4 px-5 py-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Profil Sekolah</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Informasi lengkap tentang sekolah.
                </p>
            </div>

            @if ($profil)
                <x-ui.button href="{{ route('profil_sekolah.edit') }}" startIcon="edit" class="!w-auto shrink-0">
                    Edit
                </x-ui.button>
            @endif
        </div>
        </x-ui.card>

        @if (!$profil)
            {{-- EMPTY STATE --}}
            <x-ui.card>
                <x-ui.empty-state icon="file" title="Belum Ada Profil Sekolah"
                    message="Silakan isi profil sekolah terlebih dahulu."
                    actionLabel="Isi Profil Sekolah"
                    actionHref="{{ route('profil_sekolah.edit') }}" />
            </x-ui.card>
        @else
            {{-- ============================================= --}}
            {{-- HERO: LOGO + NAMA + NPSN --}}
            {{-- ============================================= --}}
            <x-ui.card>
                <div class="flex flex-col items-center gap-5 text-center sm:flex-row sm:text-left">
                    @if ($profil->logo && Storage::disk('public')->exists($profil->logo))
                        <img src="{{ asset('storage/' . $profil->logo) }}"
                             alt="Logo {{ $profil->nama_sekolah }}"
                             class="h-24 w-24 shrink-0 rounded-2xl object-contain ring-1 ring-gray-100 dark:ring-gray-700">
                    @else
                        <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-2xl bg-slate-900 text-2xl font-bold text-white">
                            {{ strtoupper(substr($profil->nama_sekolah, 0, 2)) }}
                        </div>
                    @endif

                    <div class="min-w-0 flex-1">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
                            {{ $profil->nama_sekolah }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            NPSN {{ $profil->npsn }}
                        </p>
                        @if ($profil->alamat)
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                {{ $profil->alamat }}
                            </p>
                        @endif
                    </div>
                </div>
            </x-ui.card>

            {{-- ============================================= --}}
            {{-- GRID: INFO SEKOLAH + KEPALA SEKOLAH --}}
            {{-- ============================================= --}}
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">

                {{-- INFO SEKOLAH --}}
                <x-ui.card>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">
                        Tentang Sekolah
                    </p>

                    <dl class="mt-5 grid grid-cols-[80px_1fr] gap-x-4 gap-y-3 border-t border-gray-100 pt-4 dark:border-gray-700">
                        <dt class="text-xs text-gray-400 dark:text-gray-500">Tahun Berdiri</dt>
                        <dd class="text-sm font-medium text-gray-800 dark:text-gray-200">
                            <span class="text-xs text-gray-400 dark:text-gray-500">:&nbsp;&nbsp;</span>
                            {{ $profil->tahun_berdiri }}
                        </dd>

                        <dt class="text-xs text-gray-400 dark:text-gray-500">Kontak</dt>
                        <dd class="text-sm font-medium text-gray-800 dark:text-gray-200">
                            <span class="text-xs text-gray-400 dark:text-gray-500">:&nbsp;&nbsp;</span>
                            {{ $profil->kontak }}
                        </dd>

                        <dt class="text-xs text-gray-400 dark:text-gray-500">Alamat</dt>
                        <dd class="text-sm font-medium text-gray-800 dark:text-gray-200">
                            <span class="text-xs text-gray-400 dark:text-gray-500">:&nbsp;</span>
                            {{ $profil->alamat }}
                        </dd>
                    </dl>
                </x-ui.card>

                {{-- KEPALA SEKOLAH --}}
                <x-ui.card>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">
                        Kepala Sekolah
                    </p>

                    <div class="mt-4 flex items-center gap-4">
                        @if ($profil->foto && Storage::disk('public')->exists($profil->foto))
                            <img src="{{ asset('storage/' . $profil->foto) }}"
                                 alt="{{ $profil->kepala_sekolah }}"
                                 class="h-16 w-16 shrink-0 rounded-full object-cover ring-2 ring-emerald-500/20">
                        @else
                            <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-lg font-bold text-white">
                                {{ strtoupper(substr($profil->kepala_sekolah, 0, 2)) }}
                            </div>
                        @endif

                        <div class="min-w-0">
                            <p class="truncate text-base font-semibold text-gray-800 dark:text-white/90">
                                {{ $profil->kepala_sekolah }}
                            </p>
                            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">Kepala Sekolah</p>
                        </div>
                    </div>
                </x-ui.card>

            </div>

            {{-- ============================================= --}}
            {{-- VISI & MISI --}}
            {{-- ============================================= --}}
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <x-ui.card>
                    <div class="flex items-center gap-2">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-500/10 text-blue-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </span>
                        <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">Visi</p>
                    </div>
                    <div class="mt-3 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                        {{ $profil->visi }}
                    </div>
                </x-ui.card>

                <x-ui.card>
                    <div class="flex items-center gap-2">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M12 21a9 9 0 100-18 9 9 0 000 18z"/>
                            </svg>
                        </span>
                        <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">Misi</p>
                    </div>
                    <div class="mt-3 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                        {{ $profil->misi }}
                    </div>
                </x-ui.card>
            </div>

            {{-- ============================================= --}}
            {{-- FOTO SEKOLAH + DESKRIPSI (SEJAJAR) --}}
            {{-- ============================================= --}}
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">

                {{-- FOTO SEKOLAH --}}
                <x-ui.card :padding="false">
                    <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-700">
                        <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">
                            Foto Sekolah
                        </p>
                    </div>

                    @if ($profil->foto_sekolah && Storage::disk('public')->exists($profil->foto_sekolah))
                        <div class="p-3">
                            <img
                                src="{{ asset('storage/' . $profil->foto_sekolah) }}"
                                alt="Foto {{ $profil->nama_sekolah }}"
                                class="h-72 w-full rounded-md object-cover"
                            >
                        </div>
                    @else
                        <div class="flex h-72 items-center justify-center text-sm text-gray-400 dark:text-gray-500">
                            Belum ada foto sekolah.
                        </div>
                    @endif
                </x-ui.card>

                {{-- DESKRIPSI --}}
                <x-ui.card>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">
                        Deskripsi
                    </p>
                    <div class="mt-3 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                        {{ $profil->deskripsi }}
                    </div>
                </x-ui.card>

            </div>

        @endif

    </div>
@endsection