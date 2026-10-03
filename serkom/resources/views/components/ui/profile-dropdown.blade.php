@props([
    'name' => 'User',
    'email' => null,
    'avatar' => null,
    'showName' => true,
    'logoutRoute' => null,
])

@php
    $words = preg_split('/\s+/', trim($name));
    $initials = strtoupper(($words[0][0] ?? '') . ($words[1][0] ?? ''));
    $logoutUrl = $logoutRoute ?? (\Illuminate\Support\Facades\Route::has('logout') ? route('logout') : '#');
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false">
    {{-- Tombol pemicu: avatar + nama + chevron --}}
    <button
        type="button"
        @click="open = !open"
        class="flex items-center gap-2 rounded-full p-0.5 hover:ring-2 hover:ring-gray-200 dark:hover:ring-gray-700"
    >
        @if(!empty($avatar))
            <img src="{{ $avatar }}" alt="{{ $name }}" class="h-9 w-9 rounded-full object-cover">
        @else
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 text-xs font-semibold text-indigo-600 dark:bg-indigo-500/20 dark:text-indigo-300">
                {{ $initials }}
            </div>
        @endif

        @if($showName)
            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $name }}</span>
        @endif

        <svg
            width="14" height="14" viewBox="0 0 20 20" fill="none"
            class="text-gray-400 transition-transform dark:text-gray-500"
            :class="open ? 'rotate-180' : ''"
        >
            <path d="m5 7.5 5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>

    {{-- Panel dropdown --}}
    <div
        x-show="open"
        x-cloak
        x-transition
        class="absolute right-0 z-50 mt-2 w-56 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800"
    >
        {{-- Header: nama + email --}}
        <div class="border-b border-gray-100 px-4 py-3 dark:border-gray-700">
            <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ $name }}</p>
            @if($email)
                <p class="mt-0.5 truncate text-xs text-gray-500 dark:text-gray-400">{{ $email }}</p>
            @endif
        </div>

        {{-- Sign out --}}
        <form method="POST" action="{{ $logoutUrl }}">
            @csrf
            <button
                type="submit"
                class="flex w-full items-center gap-3 px-4 py-3 text-left text-sm font-medium text-red-600 transition hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10"
            >
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" class="text-red-500 dark:text-red-400">
                    <path d="M8 17H5a1.5 1.5 0 0 1-1.5-1.5v-11A1.5 1.5 0 0 1 5 3h3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13 13.5 17 10l-4-3.5M17 10H7.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Sign out
            </button>
        </form>
    </div>
</div>