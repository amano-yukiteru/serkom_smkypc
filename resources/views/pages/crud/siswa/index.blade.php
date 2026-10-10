@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
    <div class="space-y-5">

        {{-- BREADCRUMB --}}
        <x-ui.breadcrumb :items="[['label' => 'Siswa']]" />

        {{-- HEADER --}}
                <x-ui.card :padding="false">
        <div class="flex items-center justify-between gap-4 px-5 py-4">
        {{-- <div class="flex items-center justify-between gap-4"> --}}
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Data Siswa
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Kelola data siswa di sini.
                </p>
            </div>

            <x-ui.button
                href="{{ route('siswa.create') }}"
                startIcon="plus"
                class="!w-auto shrink-0"
            >
                Tambah Siswa
            </x-ui.button>
        {{-- </div> --}}
        </div>
        </x-ui.card>

        {{-- CARD --}}
        <x-ui.card :padding="false">

            {{-- SEARCH BAR --}}
            <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-700">
                <form method="GET" action="{{ route('siswa.index') }}"
                    class="flex items-center gap-3">

                    <div class="w-full sm:max-w-xs md:max-w-sm">
                        <x-ui.input
                            name="search"
                            type="search"
                            startIcon="search"
                            placeholder="Cari nama atau NISN..."
                            :value="request('search')"
                        />
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <x-ui.button type="submit" variant="primary" class="!w-auto">
                            Cari
                        </x-ui.button>

                        @if (request()->filled('search'))
                            <x-ui.button href="{{ route('siswa.index') }}" variant="outline" class="!w-auto">
                                Reset
                            </x-ui.button>
                        @endif
                    </div>
                </form>
            </div>

            @php
                $hasSearch = request()->filled('search');
            @endphp

            {{-- CONTENT --}}
            @if ($siswa->isEmpty() && $hasSearch)
                <x-ui.empty-state
                    icon="search"
                    title="Data Tidak Ditemukan"
                    message="Tidak ada siswa yang cocok dengan kata kunci '{{ request('search') }}'. Coba kata kunci lain."
                />

            @elseif ($siswa->isEmpty())
                <x-ui.empty-state
                    icon="user"
                    title="Belum Ada Data Siswa"
                    message="Tambahkan data siswa baru untuk memulai."
                    actionLabel="Tambah Siswa"
                    actionHref="{{ route('siswa.create') }}"
                />

            @else
                <x-ui.table
                    class="[&_th]:px-6 [&_td]:px-6 [&_th]:py-4 [&_td]:py-4"
                    :headers="['No', 'NISN', 'Nama Siswa', 'Jenis Kelamin', 'Tahun Masuk', 'Aksi']"
                    :paginator="$siswa"
                    alignLast="center"
                >
                    @foreach ($siswa as $item)
                        <x-ui.table.row>
                            <x-ui.table.td>
                                {{ $siswa->firstItem() + $loop->index }}
                            </x-ui.table.td>

                            <x-ui.table.td class="font-mono">
                                {{ $item->nisn }}
                            </x-ui.table.td>

                            <x-ui.table.td class="font-medium text-gray-800 dark:text-white/90">
                                {{ $item->nama_siswa }}
                            </x-ui.table.td>

                            <x-ui.table.td>
                                <x-ui.badge variant="{{ $item->jenis === 'Laki-Laki' ? 'primary' : 'warning' }}">
                                    {{ $item->jenis }}
                                </x-ui.badge>
                            </x-ui.table.td>

                            <x-ui.table.td>
                                {{ $item->tahun_masuk }}
                            </x-ui.table.td>

                            <x-ui.table.td align="center" fit>
                                <x-ui.table.actions
                                    :editHref="route('siswa.edit', Crypt::encrypt($item->id))"
                                    :deleteModal="'delete-siswa-' . $item->id"
                                />
                            </x-ui.table.td>
                        </x-ui.table.row>
                    @endforeach
                </x-ui.table>
            @endif
        </x-ui.card>
    </div>

    {{-- DELETE MODALS --}}
    @if ($siswa->isNotEmpty())
        @foreach ($siswa as $item)
            <x-ui.modal name="delete-siswa-{{ $item->id }}" title="Konfirmasi Hapus" maxWidth="sm">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Yakin ingin menghapus siswa
                    <strong class="text-gray-900 dark:text-white">{{ $item->nama_siswa }}</strong>
                    nisn: {{ $item->nisn }}?
                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Data yang dihapus tidak dapat dikembalikan.
                </p>

                <x-slot:footer>
                    <x-ui.button variant="outline"
                        @click="$dispatch('close-modal-delete-siswa-{{ $item->id }}')">
                        Batal
                    </x-ui.button>

                    <form action="{{ route('siswa.destroy', Crypt::encrypt($item->id)) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-ui.button type="submit" variant="danger">Hapus</x-ui.button>
                    </form>
                </x-slot:footer>
            </x-ui.modal>
        @endforeach
    @endif

@endsection