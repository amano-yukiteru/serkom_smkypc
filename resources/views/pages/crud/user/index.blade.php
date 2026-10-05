@extends('layouts.app')

@section('title', 'Data User')

@section('content')
    <div class="space-y-5">

        <x-ui.breadcrumb :items="[['label' => 'User']]" />

        {{-- HEADER --}}
        <div class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Data User</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola data user di sini.</p>
            </div>

            <x-ui.button href="{{ route('user.create') }}" startIcon="plus" class="!w-auto shrink-0">
                Tambah User
            </x-ui.button>
        </div>

        {{-- CARD --}}
        <x-ui.card :padding="false">

            {{-- FILTER --}}
            <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-700">
                <form method="GET" action="{{ route('user.index') }}" class="flex flex-wrap items-center gap-3">

                    {{-- Search --}}
                    <div class="w-full sm:max-w-xs md:max-w-sm">
                        <x-ui.input name="search" type="search" startIcon="search"
                            placeholder="Cari nama atau username..." :value="request('search')" />
                    </div>

                    {{-- Filter Role --}}
                    <div class="w-36">
                        <x-ui.select name="role" placeholder="Semua Role"
                            :value="request('role')"
                            :options="['Admin' => 'Admin', 'Oprator' => 'Oprator']" />
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-2 shrink-0">
                        <x-ui.button type="submit" variant="primary" class="!w-auto">Cari</x-ui.button>

                        @if (request()->hasAny(['search', 'role']))
                            <x-ui.button href="{{ route('user.index') }}" variant="outline" class="!w-auto">Reset</x-ui.button>
                        @endif
                    </div>
                </form>
            </div>

            @php $hasFilter = request()->hasAny(['search', 'role']); @endphp

            {{-- CONTENT --}}
            @if ($users->isEmpty() && $hasFilter)
                <x-ui.empty-state icon="search" title="Data Tidak Ditemukan"
                    message="Tidak ada user yang cocok dengan filter yang dipilih." />
            @elseif ($users->isEmpty())
                <x-ui.empty-state icon="user" title="Belum Ada Data User"
                    message="Tambahkan data user baru untuk memulai."
                    actionLabel="Tambah User"
                    actionHref="{{ route('user.create') }}" />
            @else
                <x-ui.table
                    class="[&_th]:px-6 [&_td]:px-6 [&_th]:py-4 [&_td]:py-4"
                    :headers="['No', 'Nama', 'Username', 'Role', 'Aksi']"
                    :paginator="$users"
                    alignLast="center"
                >
                    @foreach ($users as $item)
                        <x-ui.table.row>
                            {{-- No — pakai firstItem + index agar pagination benar --}}
                            <x-ui.table.td>
                                {{ $users->firstItem() + $loop->index }}
                            </x-ui.table.td>

                            <x-ui.table.td class="font-medium text-gray-800 dark:text-white/90">
                                {{ $item->name }}
                            </x-ui.table.td>

                            <x-ui.table.td class="font-mono">
                                {{ $item->username }}
                            </x-ui.table.td>

                            <x-ui.table.td>
                                {{-- Fix case: role di DB = 'Admin' atau 'Oprator' --}}
                                <x-ui.badge variant="{{ $item->role === 'Admin' ? 'primary' : 'info' }}">
                                    {{ $item->role }}
                                </x-ui.badge>
                            </x-ui.table.td>

                            <x-ui.table.td align="center" fit>
                                <x-ui.table.actions
                                    :editHref="route('user.edit', Crypt::encrypt($item->id))"
                                    :deleteModal="'delete-user-' . $item->id"
                                />
                            </x-ui.table.td>
                        </x-ui.table.row>
                    @endforeach
                </x-ui.table>
            @endif
        </x-ui.card>
    </div>

    {{-- DELETE MODALS --}}
    @if ($users->isNotEmpty())
        @foreach ($users as $item)
            <x-ui.modal name="delete-user-{{ $item->id }}" title="Konfirmasi Hapus" maxWidth="sm">
                <p class="break-words">
                    Yakin ingin menghapus user
                    <strong>{{ $item->name }}</strong>
                    @if($item->username)
                        ({{ $item->username }})
                    @endif
                    ?
                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Data yang dihapus tidak dapat dikembalikan.
                </p>

                <x-slot:footer>
                    <x-ui.button variant="outline" @click="$dispatch('close-modal-delete-user-{{ $item->id }}')">
                        Batal
                    </x-ui.button>

                    <form action="{{ route('user.destroy', Crypt::encrypt($item->id)) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-ui.button type="submit" variant="danger">Hapus</x-ui.button>
                    </form>
                </x-slot:footer>
            </x-ui.modal>
        @endforeach
    @endif

@endsection