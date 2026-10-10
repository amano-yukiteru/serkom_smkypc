@extends('layouts.app')

@section('title', 'Data Galeri')

@php
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
    <div class="space-y-5"
         x-data="{
             videoOpen: false,
             videoSrc: '',
             videoTitle: '',
             playVideo(src, title) {
                 this.videoSrc = src;
                 this.videoTitle = title;
                 this.videoOpen = true;
             }
         }">

        <x-ui.breadcrumb :items="[['label' => 'Galeri']]" />

        {{-- HEADER --}}
               <x-ui.card :padding="false">
        <div class="flex items-center justify-between gap-4 px-5 py-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Data Galeri</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola galeri foto & video sekolah.</p>
            </div>

            <x-ui.button href="{{ route('galeri.create') }}" startIcon="plus" class="!w-auto shrink-0">
                Tambah Galeri
            </x-ui.button>
        </div>
        </x-ui.card>

        {{-- FILTER --}}
        <x-ui.card :padding="false">
            <div class="px-5 py-4">
                <form method="GET" action="{{ route('galeri.index') }}" class="flex flex-wrap items-center gap-3">
                    <div class="w-full sm:max-w-xs md:max-w-sm">
                        <x-ui.input name="search" type="search" startIcon="search"
                            placeholder="Cari judul atau keterangan..." :value="request('search')" />
                    </div>

                    <div class="w-40">
                        <x-ui.select name="kategori" placeholder="Semua Kategori"
                            :value="request('kategori')"
                            :options="['Foto' => 'Foto', 'Video' => 'Video']" />
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <x-ui.button type="submit" variant="primary" class="!w-auto">Cari</x-ui.button>

                        @if (request()->hasAny(['search', 'kategori']))
                            <x-ui.button href="{{ route('galeri.index') }}" variant="outline" class="!w-auto">Reset</x-ui.button>
                        @endif
                    </div>
                </form>
            </div>
        </x-ui.card>

        @php $hasFilter = request()->filled('search') || request()->filled('kategori'); @endphp

        {{-- CONTENT --}}
        @if ($galeris->isEmpty() && $hasFilter)
            <x-ui.card>
                <x-ui.empty-state icon="search" title="Data Tidak Ditemukan"
                    message="Tidak ada galeri yang cocok dengan filter yang dipilih." />
            </x-ui.card>

        @elseif ($galeris->isEmpty())
            <x-ui.card>
                <x-ui.empty-state icon="file" title="Belum Ada Galeri"
                    message="Tambahkan foto atau video untuk memulai."
                    actionLabel="Tambah Galeri"
                    actionHref="{{ route('galeri.create') }}" />
            </x-ui.card>

        @else
            {{-- GRID GALERI --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($galeris as $item)
                    @php
                        $isVideo = $item->kategori === 'Video';

                        $media = $item->file && Storage::disk('public')->exists($item->file)
                            ? asset('storage/' . $item->file)
                            : null;
                    @endphp

                    @if ($isVideo && $media)
                        <div @click="playVideo('{{ $media }}', @js($item->judul))" class="cursor-pointer">
                            <x-ui.news-card
                                :video="$media"
                                :title="$item->judul"
                                :excerpt="Str::limit(strip_tags($item->keterangan), 120)"
                                :date="'Video'"
                                :editHref="route('galeri.edit', Crypt::encrypt($item->id))"
                                :deleteModal="'delete-galeri-' . $item->id"
                            />
                        </div>
                    @else
                        <x-ui.news-card
                            :image="$media"
                            :title="$item->judul"
                            :excerpt="Str::limit(strip_tags($item->keterangan), 120)"
                            :date="'Foto'"
                            :editHref="route('galeri.edit', Crypt::encrypt($item->id))"
                            :deleteModal="'delete-galeri-' . $item->id"
                        />
                    @endif
                @endforeach
            </div>

            {{-- MODAL DELETE --}}
            @foreach ($galeris as $item)
                <x-ui.modal name="delete-galeri-{{ $item->id }}" title="Hapus Galeri?">
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Yakin ingin menghapus
                        <strong class="text-gray-800 dark:text-white">{{ $item->judul }}</strong>?
                        Tindakan ini tidak bisa dibatalkan.
                    </p>

                    <x-slot:footer>
                        <x-ui.button
                            variant="outline"
                            class="!w-auto"
                            x-on:click="$dispatch('close-modal-delete-galeri-{{ $item->id }}')"
                        >
                            Batal
                        </x-ui.button>

                        <form action="{{ route('galeri.destroy', Crypt::encrypt($item->id)) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <x-ui.button type="submit" variant="danger" startIcon="trash" class="!w-auto">
                                Hapus
                            </x-ui.button>
                        </form>
                    </x-slot:footer>
                </x-ui.modal>
            @endforeach

            {{-- Pagination --}}
            <x-ui.card :padding="false">
                <x-ui.pagination :paginator="$galeris" variant="default" :per-page-options="[9, 18, 27]" />
            </x-ui.card>
        @endif

        {{-- VIDEO MODAL PLAYER --}}
        <div
            x-show="videoOpen"
            x-cloak
            x-transition.opacity
            @keydown.escape.window="videoOpen = false; videoSrc = ''"
            class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
        >
            <div @click="videoOpen = false; videoSrc = ''" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>

            <div x-show="videoOpen" x-transition class="relative w-full max-w-4xl">
                <button
                    type="button"
                    @click="videoOpen = false; videoSrc = ''"
                    class="absolute -top-12 right-0 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="mb-3">
                    <h3 class="text-lg font-semibold text-white" x-text="videoTitle"></h3>
                </div>

                <div class="overflow-hidden rounded-xl bg-black shadow-2xl">
                    <video
                        x-show="videoOpen"
                        x-cloak
                        x-transition.opacity
                        x-ref="videoPlayer"
                        :src="videoSrc"
                        controls
                        autoplay
                        class="h-auto w-full"
                        @play="videoOpen = true"
                        @ended="videoOpen = false"
                    ></video>
                </div>
            </div>
        </div>

    </div>
@endsection