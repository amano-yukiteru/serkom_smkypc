@extends('layouts.app')

@section('title', 'Profil Sekolah')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[['label' => 'Profil Sekolah']]" />

        {{-- HEADER --}}
        <div class="flex items-center justify-between gap-4">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Profil Sekolah</h1>

            <x-ui.button href="{{ route('profil_sekolah.edit') }}" startIcon="edit" class="!w-auto shrink-0">
                Edit
            </x-ui.button>
        </div>

        @if (!$profil)
            <x-ui.card>
                <x-ui.empty-state icon="file" title="Belum Ada Profil Sekolah"
                    message="Silakan isi profil sekolah terlebih dahulu."
                    actionLabel="Isi Profil Sekolah"
                    actionHref="{{ route('profil_sekolah.edit') }}" />
            </x-ui.card>

        @else
            {{-- CARD: KEPALA SEKOLAH --}}
            <x-ui.card>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">Kepala Sekolah</p>

                <div class="mt-4 flex items-center gap-4">
                    @if($profil->foto && Storage::disk('public')->exists($profil->foto))
                        <img src="{{ asset('storage/' . $profil->foto) }}"
                             alt="{{ $profil->kepala_sekolah }}"
                             class="h-14 w-14 rounded-full object-cover">
                    @else
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-emerald-500 text-base font-bold text-white">
                            {{ strtoupper(substr($profil->kepala_sekolah, 0, 2)) }}
                        </div>
                    @endif

                    <div class="min-w-0">
                        <p class="text-base font-semibold text-gray-800 dark:text-white/90">{{ $profil->kepala_sekolah }}</p>
                        <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">Kepala Sekolah</p>
                    </div>
                </div>
            </x-ui.card>

            {{-- 2 CARD: SEKOLAH + DESKRIPSI --}}
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">

                {{-- SEKOLAH --}}
                <x-ui.card>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">Sekolah</p>

                    <div class="mt-4 flex items-center gap-4">
                        @if($profil->logo && Storage::disk('public')->exists($profil->logo))
                            <img src="{{ asset('storage/' . $profil->logo) }}"
                                 alt="Logo"
                                 class="h-14 w-14 rounded-xl object-contain">
                        @else
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-slate-900 text-base font-bold text-white">
                                {{ strtoupper(substr($profil->nama_sekolah, 0, 2)) }}
                            </div>
                        @endif

                        <div class="min-w-0">
                            <p class="text-base font-semibold text-gray-800 dark:text-white/90">{{ $profil->nama_sekolah }}</p>
                            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">NPSN {{ $profil->npsn }}</p>
                        </div>
                    </div>

                    <dl class="mt-5 space-y-3 border-t border-gray-100 pt-4 dark:border-gray-700">
                        <div class="flex items-baseline justify-between gap-3">
                            <dt class="text-xs text-gray-400 dark:text-gray-500">Tahun Berdiri</dt>
                            <dd class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $profil->tahun_berdiri }}</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-3">
                            <dt class="text-xs text-gray-400 dark:text-gray-500">Kontak</dt>
                            <dd class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $profil->kontak }}</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-3">
                            <dt class="text-xs text-gray-400 dark:text-gray-500">Alamat</dt>
                            <dd class="text-right text-sm font-medium text-gray-800 dark:text-gray-200">{{ $profil->alamat }}</dd>
                        </div>
                    </dl>
                </x-ui.card>

                {{-- DESKRIPSI --}}
                <x-ui.card>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">Deskripsi</p>
                    <div class="mt-3 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                        {{ $profil->deskripsi }}
                    </div>
                </x-ui.card>

            </div>

            {{-- VISI & MISI --}}
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">

                <x-ui.card>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">Visi</p>
                    <div class="mt-3 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                        {{ $profil->visi }}
                    </div>
                </x-ui.card>

                <x-ui.card>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">Misi</p>
                    <div class="mt-3 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                        {{ $profil->misi }}
                    </div>
                </x-ui.card>

            </div>
        @endif

    </div>
@endsection