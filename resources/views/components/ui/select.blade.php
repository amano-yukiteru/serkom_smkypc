@props([
    'name',
    'label' => null,
    'options' => [],
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'startIcon' => null,   // bisa nama ("user") atau raw SVG
])

@php
    $hasError = $errors->has($name);
    $selected = old($name, $value);

    $selectedLabel = null;
    if ($selected !== null && isset($options[$selected])) {
        $selectedLabel = $options[$selected];
    }

    // Base style
    $baseClass = 'flex h-11 w-full items-center justify-between rounded-lg border bg-transparent text-left text-sm text-gray-800
                  shadow-theme-xs outline-hidden transition
                  focus:ring-3
                  dark:bg-gray-900 dark:text-white/90';

    $borderClass = $hasError
        ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10 dark:border-red-500 dark:focus:border-red-500'
        : 'border-gray-300 focus:border-indigo-300 focus:ring-indigo-500/10 dark:border-gray-700 dark:focus:border-indigo-800';

    // Padding dinamis kalau ada icon
    $paddingClass = $startIcon ? 'pl-10 pr-4' : 'px-4';

    // Helper: apakah nama icon atau raw SVG
    $isIconName = fn($val) => $val && !str_contains($val, '<');
@endphp

<div
    class="w-full"
    x-data="{
        open: false,
        selected: @js((string) $selected),
        selectedLabel: @js($selectedLabel),
        options: @js($options),
        placeholder: @js($placeholder),

        pick(key, label) {
            this.selected = key;
            this.selectedLabel = label;
            this.open = false;
        }
    }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
>
    @if($label)
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <div class="relative">
        {{-- START ICON (di kiri trigger) --}}
        @if($startIcon)
            <span class="pointer-events-none absolute inset-y-0 left-0 z-10 flex items-center pl-3.5 text-gray-500 dark:text-gray-400">
                @if($isIconName($startIcon))
                    <x-ui.icon :name="$startIcon" size="md" />
                @else
                    {!! $startIcon !!}
                @endif
            </span>
        @endif

        {{-- Trigger --}}
        <button
            type="button"
            @click="open = !open"
            {{ $attributes->merge(['class' => "$baseClass $borderClass $paddingClass"]) }}
        >
            <span
                :class="selectedLabel ? 'text-gray-800 dark:text-white/90' : 'text-gray-400 dark:text-gray-500'"
                x-text="selectedLabel || placeholder || 'Pilih opsi'"
            ></span>

            <svg
                class="h-4 w-4 shrink-0 text-gray-500 transition-transform duration-200 dark:text-gray-400"
                :class="open ? 'rotate-180' : ''"
                viewBox="0 0 20 20"
                fill="none"
            >
                <path d="m6 8 4 4 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

        {{-- Dropdown Panel --}}
        <div
            x-show="open"
            x-cloak
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-1"
            class="absolute left-0 right-0 z-50 mt-2 max-h-60 overflow-y-auto rounded-lg border border-gray-300 bg-white py-1.5 shadow-lg dark:border-gray-700 dark:bg-gray-900"
        >
            <template x-for="(label, key) in options" :key="key">
                <button
                    type="button"
                    @click="pick(key, label)"
                    class="group flex w-full items-center justify-between gap-2 px-4 py-2.5 text-left text-sm transition-colors"
                    :class="{
                        'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400': String(selected) === String(key),
                        'text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800': String(selected) !== String(key),
                    }"
                >
                    <span x-text="label"></span>

                    <svg
                        x-show="String(selected) === String(key)"
                        class="h-4 w-4 shrink-0 text-indigo-500 dark:text-indigo-400"
                        viewBox="0 0 20 20"
                        fill="none"
                    >
                        <path d="M16.6666 5L8.24992 13.4167L3.33325 8.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </template>

            <template x-if="Object.keys(options).length === 0">
                <p class="px-4 py-3 text-center text-sm text-gray-400 dark:text-gray-500">
                    Tidak ada opsi
                </p>
            </template>
        </div>

        {{-- Hidden input --}}
        <input type="hidden" name="{{ $name }}" :value="selected" @if($required) required @endif>
    </div>

    @error($name)
        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>