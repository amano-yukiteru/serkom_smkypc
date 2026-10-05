@extends('layouts.app')

@section('title', 'Data Guru')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[['label' => 'Guru']]" />

        {{-- HEADER --}}
        <div class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Data Guru</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola data guru di sini.</p>
            </div>

            <x-ui.button href="{{ route('guru.create') }}" startIcon="plus" class="!w-auto shrink-0">
                Tambah Guru
            </x-ui.button>
        </div>

        <x-ui.card :padding="false">

            {{-- SEARCH --}}
            <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-700">
                <form method="GET" action="{{ route('guru.index') }}" class="flex items-center gap-3">
                    <div class="w-full sm:max-w-xs md:max-w-sm">
                        <x-ui.input name="search" type="search" startIcon="search"
                            placeholder="Cari nama, NIP, atau mapel" :value="request('search')" />
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <x-ui.button type="submit" variant="primary" class="!w-auto">Cari</x-ui.button>

                        @if (request()->filled('search'))
                            <x-ui.button href="{{ route('guru.index') }}" variant="outline" class="!w-auto">Reset</x-ui.button>
                        @endif
                    </div>
                </form>
            </div>

            @php $hasSearch = request()->filled('search'); @endphp

            {{-- CONTENT --}}
            @if ($gurus->isEmpty() && $hasSearch)
                <x-ui.empty-state icon="search" title="Data Tidak Ditemukan"
                    message="Tidak ada guru yang cocok dengan kata kunci '{{ request('search') }}'." />

            @elseif ($gurus->isEmpty())
                <x-ui.empty-state icon="user" title="Belum Ada Data Guru"
                    message="Tambahkan data guru baru untuk memulai."
                    actionLabel="Tambah Guru"
                    actionHref="{{ route('guru.create') }}" />

            @else
                <x-ui.table
                    class="[&_th]:px-6 [&_td]:px-6 [&_th]:py-4 [&_td]:py-4"
                    :headers="['No', 'Foto', 'Nama Guru', 'NIP', 'Mapel', 'Aksi']"
                    :paginator="$gurus"
                    alignLast="center"
                >
                    @foreach ($gurus as $item)
                        <x-ui.table.row>
                            <x-ui.table.td>{{ $gurus->firstItem() + $loop->index }}</x-ui.table.td>

                            {{-- Foto dengan fallback --}}
                            <x-ui.table.td>
                                @if($item->foto && Storage::disk('public')->exists($item->foto))
                                    <img
                                        src="{{ asset('storage/' . $item->foto) }}"
                                        alt="{{ $item->nama_guru }}"
                                        class="h-10 w-10 rounded-full object-cover ring-2 ring-gray-100 dark:ring-gray-700"
                                    >
                                @else
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-xs font-semibold text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                        {{ strtoupper(substr($item->nama_guru, 0, 2)) }}
                                    </div>
                                @endif
                            </x-ui.table.td>

                            <x-ui.table.td class="font-medium text-gray-800 dark:text-white/90">
                                {{ $item->nama_guru }}
                            </x-ui.table.td>

                            <x-ui.table.td class="font-mono">{{ $item->nip }}</x-ui.table.td>

                            <x-ui.table.td>{{ $item->mapel }}</x-ui.table.td>

                            <x-ui.table.td align="center" fit>
                                <x-ui.table.actions
                                    :editHref="route('guru.edit', Crypt::encrypt($item->id))"
                                    :deleteModal="'delete-guru-' . $item->id"
                                />
                            </x-ui.table.td>
                        </x-ui.table.row>
                    @endforeach
                </x-ui.table>
            @endif
        </x-ui.card>
    </div>

    {{-- DELETE MODALS --}}
    @if ($gurus->isNotEmpty())
        @foreach ($gurus as $item)
            <x-ui.modal name="delete-guru-{{ $item->id }}" title="Konfirmasi Hapus" maxWidth="sm">
                <p>
                    Yakin ingin menghapus guru
                    <strong>{{ $item->nama_guru }}</strong>
                    (NIP: {{ $item->nip }})?
                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Data yang dihapus tidak dapat dikembalikan.
                </p>

                <x-slot:footer>
                    <x-ui.button variant="outline" @click="$dispatch('close-modal-delete-guru-{{ $item->id }}')">
                        Batal
                    </x-ui.button>

                    <form action="{{ route('guru.destroy', Crypt::encrypt($item->id)) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-ui.button type="submit" variant="danger">Hapus</x-ui.button>
                    </form>
                </x-slot:footer>
            </x-ui.modal>
        @endforeach
    @endif

@endsection