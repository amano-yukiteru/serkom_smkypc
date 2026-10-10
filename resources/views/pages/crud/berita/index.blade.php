@extends('layouts.app')

@section('title', 'Data Berita')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[['label' => 'Berita']]" />

        {{-- HEADER --}}
        <x-ui.card :padding="false">
            <div class="flex items-center justify-between gap-4 px-5 py-4">
                <div class="min-w-0">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Data Berita</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola berita sekolah di sini.</p>
                </div>
    
                <x-ui.button href="{{ route('berita.create') }}" startIcon="plus" class="!w-auto shrink-0">
                    Tambah Berita
                </x-ui.button>
            </div>
        </x-ui.card>


        {{-- FILTER --}}
        <x-ui.card :padding="false">
            <div class="px-5 py-4">
                <form method="GET" action="{{ route('berita.index') }}" class="flex flex-wrap items-center gap-3">

                    {{-- Search --}}
                    <div class="w-full sm:max-w-xs md:max-w-sm">
                        <x-ui.input name="search" type="search" startIcon="search"
                            placeholder="Cari judul atau isi berita..." :value="request('search')" />
                    </div>

                    {{-- Bulan --}}
                    <div class="w-36">
                        <x-ui.select name="bulan" placeholder="Semua Bulan" :value="request('bulan')" :options="[
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember',
                        ]" />
                    </div>

                    {{-- Tahun --}}
                    <div class="w-36">
                        <x-ui.select name="tahun" placeholder="Semua Tahun" :value="request('tahun')"
                            :options="$tahunList->mapWithKeys(fn($t) => [$t => $t])->toArray()" />
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-2 shrink-0">
                        <x-ui.button type="submit" variant="primary" class="!w-auto">Cari</x-ui.button>

                        @if (request()->hasAny(['search', 'bulan', 'tahun']))
                            <x-ui.button href="{{ route('berita.index') }}" variant="outline"
                                class="!w-auto">Reset</x-ui.button>
                        @endif
                    </div>

                </form>
            </div>
        </x-ui.card>

        @php $hasSearch = request()->filled('search'); @endphp

        {{-- CONTENT --}}
        @if ($beritas->isEmpty() && $hasSearch)
            <x-ui.card>
                <x-ui.empty-state icon="search" title="Data Tidak Ditemukan"
                    message="Tidak ada berita yang cocok dengan kata kunci '{{ request('search') }}'." />
            </x-ui.card>

        @elseif ($beritas->isEmpty())
            <x-ui.card>
                <x-ui.empty-state icon="file" title="Belum Ada Berita" message="Tambahkan berita baru untuk memulai."
                    actionLabel="Tambah Berita" actionHref="{{ route('berita.create') }}"/>
            </x-ui.card>

        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                @foreach ($beritas as $item)
                    <x-ui.news-card
                        :image="$item->gambar && Storage::disk('public')->exists($item->gambar)
                            ? asset('storage/' . $item->gambar)
                            : null"
                        :title="$item->judul"
                        :excerpt="Str::limit(strip_tags($item->isi), 120)"
                        :date="$item->tanggal
                            ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y')
                            : null"
                        :author="$item->user?->name ?? 'Anonim'"
                        :editHref="route('berita.edit', Crypt::encrypt($item->id))"
                        :deleteModal="'delete-berita-' . $item->id"
                    />
                @endforeach
            </div>

            {{-- Pagination — tanpa @if, biar per_page selector tetap muncul --}}
            <x-ui.card :padding="false">
                <x-ui.pagination :paginator="$beritas" variant="default" :per-page-options="[9, 18, 27]" />
            </x-ui.card>
        @endif
    </div>

    {{-- DELETE MODALS --}}
    @if ($beritas->isNotEmpty())
        @foreach ($beritas as $item)
            <x-ui.modal name="delete-berita-{{ $item->id }}" title="Konfirmasi Hapus" maxWidth="sm">
                <p class="break-words">
                    Yakin ingin menghapus berita
                    <strong>{{ $item->judul }}</strong>?
                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Data yang dihapus tidak dapat dikembalikan.
                </p>

                <x-slot:footer>
                    <x-ui.button variant="outline" @click="$dispatch('close-modal-delete-berita-{{ $item->id }}')">
                        Batal
                    </x-ui.button>

                    <form action="{{ route('berita.destroy', Crypt::encrypt($item->id)) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-ui.button type="submit" variant="danger">Hapus</x-ui.button>
                    </form>
                </x-slot:footer>
            </x-ui.modal>
        @endforeach
    @endif

@endsection