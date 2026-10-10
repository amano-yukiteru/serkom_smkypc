@extends('layouts.app')

@section('title', 'Data Kerjasama')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[['label' => 'Kerjasama']]" />

        {{-- HEADER --}}
        <x-ui.card :padding="false">
            <div class="flex items-center justify-between gap-4 px-5 py-4">
                <div class="min-w-0">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Data Kerjasama</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola data kerjasama perusahaan di sini.</p>
                </div>

                <x-ui.button href="{{ route('kerjasama.create') }}" startIcon="plus" class="!w-auto shrink-0">
                    Tambah Kerjasama
                </x-ui.button>
            </div>
        </x-ui.card>

        {{-- FILTER --}}
        <x-ui.card :padding="false">
            <div class="px-5 py-4">
                <form method="GET" action="{{ route('kerjasama.index') }}" class="flex flex-wrap items-center gap-3">
                    <div class="w-full sm:max-w-md">
                        <x-ui.input name="search" type="search" startIcon="search"
                            placeholder="Cari nama perusahaan..." :value="request('search')" />
                    </div>

                    {{-- <div class="w-full sm:w-auto sm:min-w-[180px]">
                        <x-ui.select name="kategori" :value="request('kategori')"
                            :options="[
                                'MoU' => 'MoU',
                                'MoA' => 'MoA',
                                'PKS' => 'PKS',
                            ]"
                            placeholder="Semua Kategori" />
                    </div> --}}

                    <div class="flex items-center gap-2 shrink-0">
                        <x-ui.button type="submit" variant="primary" class="!w-auto">Cari</x-ui.button>

                        @if (request()->filled('search') || request()->filled('kategori'))
                            <x-ui.button href="{{ route('kerjasama.index') }}" variant="outline" class="!w-auto">Reset</x-ui.button>
                        @endif
                    </div>
                </form>
            </div>
        </x-ui.card>

        @php $hasFilter = request()->filled('search') || request()->filled('kategori'); @endphp

        {{-- CONTENT --}}
        @if ($kerjasama->isEmpty() && $hasFilter)
            <x-ui.card>
                <x-ui.empty-state icon="search" title="Data Tidak Ditemukan"
                    message="Tidak ada kerjasama yang cocok dengan filter." />
            </x-ui.card>

        @elseif ($kerjasama->isEmpty())
            <x-ui.card>
                <x-ui.empty-state icon="file" title="Belum Ada Kerjasama"
                    message="Tambahkan data kerjasama baru untuk memulai."
                    actionLabel="Tambah Kerjasama"
                    actionHref="{{ route('kerjasama.create') }}" />
            </x-ui.card>

        @else
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($kerjasama as $item)
                    <x-ui.news-card
                        :image="$item->foto && Storage::disk('public')->exists($item->foto)
                            ? asset('storage/' . $item->foto)
                            : null"
                        :title="$item->nama_perusahaan"
                        {{-- :excerpt="Str::limit(strip_tags($item->kategori), 120)" --}}
                        :date="$item->kategori"
                        :editHref="route('kerjasama.edit', Crypt::encrypt($item->id))"
                        :deleteModal="'delete-kerjasama-' . $item->id"
                    />
                @endforeach
            </div>

            {{-- Pagination --}}
            <x-ui.card :padding="false">
                <x-ui.pagination :paginator="$kerjasama" variant="default" :per-page-options="[9, 18, 27]" />
            </x-ui.card>
        @endif
    </div>

    {{-- DELETE MODALS --}}
    @if ($kerjasama->isNotEmpty())
        @foreach ($kerjasama as $item)
            <x-ui.modal name="delete-kerjasama-{{ $item->id }}" title="Konfirmasi Hapus" maxWidth="sm">
                <p class="break-words">
                    Yakin ingin menghapus kerjasama <strong>{{ $item->nama_perusahaan }}</strong>?
                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Data yang dihapus tidak dapat dikembalikan.
                </p>

                <x-slot:footer>
                    <x-ui.button variant="outline" @click="$dispatch('close-modal-delete-kerjasama-{{ $item->id }}')">
                        Batal
                    </x-ui.button>

                    <form action="{{ route('kerjasama.destroy', Crypt::encrypt($item->id)) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-ui.button type="submit" variant="danger">Hapus</x-ui.button>
                    </form>
                </x-slot:footer>
            </x-ui.modal>
        @endforeach
    @endif
@endsection