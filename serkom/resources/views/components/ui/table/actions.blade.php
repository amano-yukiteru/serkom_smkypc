@props([
    'editHref' => null,
    'deleteModal' => null,
])

<div class="inline-flex items-center justify-center gap-1">
    @if($editHref)
        <a
            href="{{ $editHref }}"
            title="Edit"
            class="inline-flex h-7 w-auto select-none items-center gap-1 whitespace-nowrap rounded-md bg-amber-400 px-2 text-[11px] font-medium text-gray-900 shadow-sm transition hover:bg-amber-500"
        >
            <svg class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16.862 4.487a2.06 2.06 0 0 1 2.914 2.914L8.5 18.677l-4 1 1-4Z" />
            </svg>
            <span>Edit</span>
        </a>
    @endif

    @if($deleteModal)
        <button
            type="button"
            @click="$dispatch('open-modal-{{ $deleteModal }}')"
            title="Hapus"
            class="inline-flex h-7 w-auto select-none items-center gap-1 whitespace-nowrap rounded-md bg-red-500 px-2 text-[11px] font-medium text-white shadow-sm transition hover:bg-red-600"
        >
            <svg class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 7h12M9.5 7V5.5A1.5 1.5 0 0 1 11 4h2a1.5 1.5 0 0 1 1.5 1.5V7m1.5 0-.6 12.1a2 2 0 0 1-2 1.9H9.6a2 2 0 0 1-2-1.9L7 7" />
            </svg>
            <span>Hapus</span>
        </button>
    @endif

    {{ $slot ?? '' }}
</div>