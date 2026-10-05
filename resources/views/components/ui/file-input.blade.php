@props([
    'name',
    'label' => null,
    'accept' => 'image/*,video/*',
    'preview' => null,       // URL gambar/video existing (dari DB)
    'required' => false,
    'hint' => null,
])

@php
    $hasError = $errors->has($name);

    // Deteksi tipe preview
    $previewIsVideo = $preview && preg_match('/\.(mp4|webm|mov|avi|mkv|ogv)$/i', $preview);
@endphp

<div
    class="w-full"
    x-data="{
        fileName: null,
        localPreview: null,
        localType: null,
        hasPreview: {{ $preview ? 'true' : 'false' }},

        handleChange(event) {
            const file = event.target.files[0];
            if (!file) return;

            this.fileName = file.name;
            this.localType = file.type;

            const reader = new FileReader();
            reader.onload = (e) => {
                this.localPreview = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }"
>
    @if($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <div class="flex items-center gap-3">
        {{-- Preview thumbnail --}}
        <div class="shrink-0">
            {{-- Local preview (baru dipilih) --}}
            <template x-if="localPreview">
                <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-lg border border-dashed border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-800">
                    <template x-if="localType && localType.startsWith('video/')">
                        <video :src="localPreview" class="h-full w-full object-cover" muted></video>
                    </template>
                    <template x-if="localType && localType.startsWith('image/')">
                        <img :src="localPreview" class="h-full w-full object-cover" />
                    </template>
                    <template x-if="localType && !localType.startsWith('image/') && !localType.startsWith('video/')">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </template>
                </div>
            </template>

            {{-- Preview dari DB --}}
            <template x-if="!localPreview && hasPreview">
                <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-lg border border-dashed border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-800">
                    @if($previewIsVideo)
                        <video src="{{ $preview }}" class="h-full w-full object-cover" muted></video>
                    @else
                        <img src="{{ $preview }}" class="h-full w-full object-cover" />
                    @endif
                </div>
            </template>

            {{-- Fallback (belum ada file) --}}
            <template x-if="!localPreview && !hasPreview">
                <div class="flex h-16 w-16 items-center justify-center rounded-lg border border-dashed border-gray-300 bg-gray-50 text-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
            </template>
        </div>

        {{-- Drop zone area (border dashed, samain dengan thumbnail) --}}
        <label
            for="{{ $name }}"
            @class([
                'flex flex-1 cursor-pointer items-center justify-center gap-2 rounded-lg border border-dashed px-4 py-3.5 text-center text-sm font-medium transition min-h-16',
                'border-red-400 text-red-500 hover:border-red-500 dark:border-red-500/60' => $hasError,
                'border-gray-300 text-gray-500 hover:border-brand-500 hover:bg-brand-50/40 hover:text-brand-600 dark:border-gray-600 dark:text-gray-400 dark:hover:border-brand-500 dark:hover:bg-brand-500/5 dark:hover:text-brand-400' => !$hasError,
            ])
        >
            <input
                type="file"
                id="{{ $name }}"
                name="{{ $name }}"
                accept="{{ $accept }}"
                @if($required) required @endif
                class="hidden"
                @change="handleChange($event)"
            />

            {{-- Icon upload --}}
            <svg class="h-4 w-4 shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                <polyline points="17 8 12 3 7 8" />
                <line x1="12" y1="3" x2="12" y2="15" />
            </svg>

            <span
                x-text="fileName || 'Klik untuk unggah file'"
                class="truncate max-w-xs text-brand-500 dark:text-brand-400"
            ></span>
        </label>
    </div>

    @if($hint && !$hasError)
        <p class="mt-1.5 text-xs text-gray-400 dark:text-gray-500">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>