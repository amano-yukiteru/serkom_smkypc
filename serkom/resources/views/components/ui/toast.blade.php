@props([
    'position' => 'top-right',
])

@php
    $positionClass = match($position) {
        'top-left'     => 'top-4 left-4 sm:top-6 sm:left-6',
        'bottom-right' => 'bottom-4 right-4 sm:bottom-6 sm:right-6',
        'bottom-left'  => 'bottom-4 left-4 sm:bottom-6 sm:left-6',
        default        => 'top-4 right-4 sm:top-6 sm:right-6',
    };

    // Pull flash sekali — biar tidak dobel saat Alpine re-init
    $flashMessages = [];
    $flashMap = [
        'success' => ['type' => 'success', 'title' => 'Berhasil'],
        'error'   => ['type' => 'danger',  'title' => 'Gagal'],
        'warning' => ['type' => 'warning', 'title' => 'Perhatian'],
        'info'    => ['type' => 'info',    'title' => 'Info'],
    ];

    foreach ($flashMap as $key => $meta) {
        if (session()->has($key)) {
            $flashMessages[] = [
                'type'    => $meta['type'],
                'title'   => $meta['title'],
                'message' => session()->pull($key),   // baca + hapus dari session
            ];
        }
    }
@endphp

{{-- Style untuk animasi progress --}}
<style>
    @keyframes toast-progress {
        from { width: 100%; }
        to   { width: 0%; }
    }
    .toast-progress {
        animation: toast-progress linear forwards;
    }
</style>

<div
    x-data="toastManager({ flashes: @js($flashMessages) })"
    x-init="init()"
    @toast.window="add($event.detail)"
    class="pointer-events-none fixed z-[9999] flex w-full max-w-sm flex-col gap-3 {{ $positionClass }}"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="toast.show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-4"
            class="pointer-events-auto relative overflow-hidden rounded-xl border bg-white p-4 shadow-lg dark:bg-gray-800"
            :class="{
                'border-emerald-200 dark:border-emerald-500/30': toast.type === 'success',
                'border-red-200 dark:border-red-500/30': toast.type === 'danger',
                'border-amber-200 dark:border-amber-500/30': toast.type === 'warning',
                'border-blue-200 dark:border-blue-500/30': toast.type === 'info',
            }"
        >
            <div class="flex items-start gap-3">
                {{-- Icon --}}
                <div
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full"
                    :class="{
                        'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400': toast.type === 'success',
                        'bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400': toast.type === 'danger',
                        'bg-amber-100 text-amber-600 dark:bg-amber-500/20 dark:text-amber-400': toast.type === 'warning',
                        'bg-blue-100 text-blue-600 dark:bg-blue-500/20 dark:text-blue-400': toast.type === 'info',
                    }"
                >
                    <svg x-show="toast.type === 'success'" class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                        <path d="M16.6666 5L8.24992 13.4167L3.33325 8.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg x-show="toast.type === 'danger'" class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                        <path d="M6 6l8 8M14 6l-8 8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                    <svg x-show="toast.type === 'warning'" class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                        <path d="M10 6v6M10 14.5v.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                    <svg x-show="toast.type === 'info'" class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                        <circle cx="10" cy="10" r="7" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M10 9v4M10 6.5v.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>

                {{-- Content --}}
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-gray-800 dark:text-white" x-text="toast.title"></p>
                    <p x-show="toast.message" class="mt-0.5 text-sm text-gray-500 dark:text-gray-400" x-text="toast.message"></p>
                </div>

                {{-- Close --}}
                <button
                    type="button"
                    @click="remove(toast.id)"
                    class="shrink-0 rounded-md p-1 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                >
                    <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none">
                        <path d="M6 6l8 8M14 6l-8 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>

            {{-- Progress bar --}}
            <div
                class="toast-progress absolute bottom-0 left-0 h-0.5"
                :class="{
                    'bg-emerald-500': toast.type === 'success',
                    'bg-red-500': toast.type === 'danger',
                    'bg-amber-500': toast.type === 'warning',
                    'bg-blue-500': toast.type === 'info',
                }"
                :style="`animation-duration: ${toast.duration}ms;`"
            ></div>
        </div>
    </template>
</div>

@push('scripts')
<script>
function toastManager(config = {}) {
    return {
        toasts: [],
        recentKeys: new Set(),

        init() {
            // Flash dari session — sudah di-pull server-side, jadi pasti sekali
            const flashes = config.flashes || [];
            flashes.forEach(f => this.add(f));
        },

        add(data) {
            if (!data) return;

            // Dedupe: skip kalau konten sama muncul lagi dalam 800ms
            const key = [data.type || 'info', data.title || '', data.message || ''].join('|');
            if (this.recentKeys.has(key)) return;

            this.recentKeys.add(key);
            setTimeout(() => this.recentKeys.delete(key), 800);

            const id = Date.now() + Math.random();
            const toast = {
                id,
                type: data.type || 'info',
                title: data.title || 'Notifikasi',
                message: data.message || '',
                duration: data.duration || 4000,
                show: true,
            };

            this.toasts.push(toast);

            setTimeout(() => {
                this.remove(id);
            }, toast.duration);
        },

        remove(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index !== -1) {
                this.toasts[index].show = false;
                setTimeout(() => {
                    this.toasts.splice(index, 1);
                }, 200);
            }
        }
    }
}
</script>
@endpush