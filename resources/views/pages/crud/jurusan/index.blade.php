@extends('layouts.app')

@section('title', 'Data Jurusan')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[['label' => 'Jurusan']]" />

        {{-- HEADER --}}
        <x-ui.card :padding="false">
        <div class="flex items-center justify-between gap-4 px-5 py-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Data Jurusan</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola jurusan sekolah di sini.</p>
            </div>

            <x-ui.button href="{{ route('jurusan.create') }}" startIcon="plus" class="!w-auto shrink-0">
                Tambah Jurusan
            </x-ui.button>
        </div>
        </x-ui.card>

        {{-- FILTER --}}
        <x-ui.card :padding="false">
            <div class="px-5 py-4">
                <form method="GET" action="{{ route('jurusan.index') }}" class="flex flex-wrap items-center gap-3">
                    <div class="w-full sm:max-w-md">
                        <x-ui.input name="search" type="search" startIcon="search"
                            placeholder="Cari nama atau singkatan..." :value="request('search')" />
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <x-ui.button type="submit" variant="primary" class="!w-auto">Cari</x-ui.button>

                        @if (request()->filled('search'))
                            <x-ui.button href="{{ route('jurusan.index') }}" variant="outline" class="!w-auto">Reset</x-ui.button>
                        @endif
                    </div>
                </form>
            </div>
        </x-ui.card>

        @php $hasFilter = request()->filled('search'); @endphp

        {{-- CONTENT --}}
        @if ($jurusans->isEmpty() && $hasFilter)
            <x-ui.card>
                <x-ui.empty-state icon="search" title="Data Tidak Ditemukan"
                    message="Tidak ada jurusan yang cocok dengan pencarian." />
            </x-ui.card>

        @elseif ($jurusans->isEmpty())
            <x-ui.card>
                <x-ui.empty-state icon="file" title="Belum Ada Jurusan"
                    message="Tambahkan jurusan baru untuk memulai."
                    actionLabel="Tambah Jurusan"
                    actionHref="{{ route('jurusan.create') }}" />
            </x-ui.card>

        @else
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($jurusans as $item)
                    <x-ui.news-card
                        :image="$item->logo && Storage::disk('public')->exists($item->logo)
                            ? asset('storage/' . $item->logo)
                            : null"
                        :title="$item->nama"
                        :excerpt="Str::limit(strip_tags($item->deskripsi), 120)"
                        :date="$item->singkatan"
                        {{-- :author="$item->siswas_count . ' siswa'" --}}
                        :editHref="route('jurusan.edit', Crypt::encrypt($item->id))"
                        :deleteModal="'delete-jurusan-' . $item->id"
                    />
                @endforeach
            </div>

            {{-- Pagination --}}
            <x-ui.card :padding="false">
                <x-ui.pagination :paginator="$jurusans" variant="default" :per-page-options="[9, 18, 27]" />
            </x-ui.card>
        @endif
    </div>

    {{-- DELETE MODALS --}}
    @if ($jurusans->isNotEmpty())
        @foreach ($jurusans as $item)
            <x-ui.modal name="delete-jurusan-{{ $item->id }}" title="Konfirmasi Hapus" maxWidth="sm">
                <p class="break-words">
                    Yakin ingin menghapus jurusan <strong>{{ $item->nama }}</strong>?
                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Data yang dihapus tidak dapat dikembalikan.
                </p>

                <x-slot:footer>
                    <x-ui.button variant="outline" @click="$dispatch('close-modal-delete-jurusan-{{ $item->id }}')">
                        Batal
                    </x-ui.button>

                    <form action="{{ route('jurusan.destroy', Crypt::encrypt($item->id)) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-ui.button type="submit" variant="danger">Hapus</x-ui.button>
                    </form>
                </x-slot:footer>
            </x-ui.modal>
        @endforeach
    @endif
@endsection