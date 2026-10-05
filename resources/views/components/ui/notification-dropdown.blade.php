{{--
    TailAdmin-style Notification Dropdown — Blade Component
    Simpan file ini di: resources/views/components/notification-dropdown.blade.php

    Requires Alpine.js (sama seperti komponen date-picker).

    Pemakaian di header/navbar:
        <x-notification-dropdown :notifications="$notifications" />

    Struktur data $notifications (Collection atau array), tiap item idealnya:
        [
            'id'      => 1,
            'title'   => 'Ahmad Fauzi',                 // nama/pengirim, ditampilkan tebal
            'message' => 'Mengirim pesan baru untukmu',  // isi notifikasi
            'time'    => '5 menit lalu',                  // sudah diformat (pakai ->diffForHumans())
            'read'    => false,                           // true/false, kontrol titik indikator
            'avatar'  => null,                             // url gambar, opsional (fallback inisial)
            'url'     => '#',                              // link tujuan saat item diklik
        ]

    Kalau belum ada data asli dari controller, kirim collect() kosong — komponen
    akan menampilkan pesan "Tidak ada notifikasi".
--}}
@props([
    'notifications' => collect(),
    'markAllRoute' => null,   // route/url untuk "Tandai semua dibaca" (opsional)
    'viewAllRoute' => null,   // route/url untuk "Lihat semua notifikasi" (opsional)
])

@php
    $items = collect($notifications)->values();
    $unreadCount = $items->where('read', false)->count();
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false">
    {{-- Tombol lonceng --}}
    <button
        type="button"
        @click="open = !open"
        class="relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
    >
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M10 2a5.5 5.5 0 0 0-5.5 5.5v2.19c0 .56-.2 1.1-.57 1.53L2.8 12.6c-.86 1-.15 2.56 1.17 2.56h12.06c1.32 0 2.03-1.56 1.17-2.56l-1.13-1.38a2.35 2.35 0 0 1-.57-1.53V7.5A5.5 5.5 0 0 0 10 2Z"
                  stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M7.5 16.5a2.5 2.5 0 0 0 5 0" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
        </svg>

        @if($unreadCount > 0)
            <span class="absolute right-1 top-1 flex h-2.5 w-2.5">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-red-500"></span>
            </span>
        @endif
    </button>

    {{-- Panel dropdown --}}
    <div
        x-show="open"
        x-cloak
        x-transition
        class="absolute right-0 z-40 mt-2 w-80 sm:w-96 rounded-xl border border-gray-200 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-100 px-4 py-3 dark:border-gray-700">
            <div>
                <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Notifikasi</h3>
                @if($unreadCount > 0)
                    <p class="text-xs text-gray-400 dark:text-gray-500">{{ $unreadCount }} belum dibaca</p>
                @endif
            </div>

            @if($markAllRoute && $unreadCount > 0)
                <a href="{{ $markAllRoute }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400">
                    Tandai semua dibaca
                </a>
            @endif
        </div>

        {{-- Daftar notifikasi --}}
        <div class="max-h-80 overflow-y-auto">
            @forelse($items as $item)
                @php
                    $initial = strtoupper(substr($item['title'] ?? '?', 0, 1));
                @endphp
                <a
                    href="{{ $item['url'] ?? '#' }}"
                    class="flex gap-3 border-b border-gray-50 px-4 py-3 last:border-b-0 hover:bg-gray-50 dark:border-gray-700/60 dark:hover:bg-gray-700/40"
                >
                    <div class="relative shrink-0">
                        @if(!empty($item['avatar']))
                            <img src="{{ $item['avatar'] }}" alt="" class="h-10 w-10 rounded-full object-cover">
                        @else
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600 dark:bg-indigo-500/20 dark:text-indigo-300">
                                {{ $initial }}
                            </div>
                        @endif
                        @if(empty($item['read']))
                            <span class="absolute -right-0.5 -top-0.5 h-2.5 w-2.5 rounded-full border-2 border-white bg-red-500 dark:border-gray-800"></span>
                        @endif
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm text-gray-700 dark:text-gray-200">
                            <span class="font-semibold text-gray-800 dark:text-white">{{ $item['title'] ?? '' }}</span>
                            @if(!empty($item['message']))
                                <span class="text-gray-500 dark:text-gray-400"> {{ $item['message'] }}</span>
                            @endif
                        </p>
                        <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">{{ $item['time'] ?? '' }}</p>
                    </div>
                </a>
            @empty
                <div class="px-4 py-8 text-center text-sm text-gray-400 dark:text-gray-500">
                    Tidak ada notifikasi.
                </div>
            @endforelse
        </div>

        {{-- Footer --}}
        @if($viewAllRoute)
            <div class="border-t border-gray-100 px-4 py-3 text-center dark:border-gray-700">
                <a href="{{ $viewAllRoute }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400">
                    Lihat semua notifikasi
                </a>
            </div>
        @endif
    </div>
</div>
