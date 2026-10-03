@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'hint' => null,
    'startIcon' => null,   // bisa nama ("email") atau raw SVG ("<svg>...</svg>")
    'endIcon' => null,
])

@php
    $hasError = $errors->has($name);
    $inputId = $name . '-' . Str::random(6);

    // Flag tipe khusus
    $isNumber = $type === 'number';
    $isPassword = $type === 'password';

    // Base style
    $baseClass = 'h-11 w-full rounded-lg border bg-transparent py-2.5 text-sm text-gray-800
                  placeholder:text-gray-400 shadow-theme-xs outline-hidden transition
                  focus:ring-3
                  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30';

    // Hide spinner number
    $baseClass .= ' [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none';
    if ($isNumber) {
        $baseClass .= ' [appearance:textfield] [-moz-appearance:textfield]';
    }

    // Border & focus
    $borderClass = $hasError
        ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10 dark:border-red-500 dark:focus:border-red-500'
        : 'border-gray-300 focus:border-indigo-300 focus:ring-indigo-500/10 dark:border-gray-700 dark:focus:border-indigo-800';

    // Padding
    if ($isPassword) {
        $paddingClass = $startIcon ? 'pl-10 pr-11' : 'pl-4 pr-11';
    } else {
        $paddingClass = ($startIcon && $endIcon) ? 'pl-10 pr-10'
                      : ($startIcon ? 'pl-10 pr-4'
                      : ($endIcon  ? 'pl-4 pr-10'
                      : 'px-4'));
    }

    // Helper: apakah string ini nama icon atau raw SVG?
    $isIconName = fn($val) => $val && !str_contains($val, '<');
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $inputId }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <div class="relative" @if($isPassword) x-data="{ show: false }" @endif>
        {{-- START ICON --}}
        @if($startIcon)
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-500 dark:text-gray-400">
                @if($isIconName($startIcon))
                    <x-ui.icon :name="$startIcon" size="md" />
                @else
                    {!! $startIcon !!}
                @endif
            </span>
        @endif

        {{-- INPUT --}}
        <input
            @if($isPassword)
                :type="show ? 'text' : 'password'"
            @else
                type="{{ $type }}"
            @endif
            name="{{ $name }}"
            id="{{ $inputId }}"
            value="{{ old($name, $value) }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($required) required @endif

            @if($isNumber)
                inputmode="numeric"
                pattern="[0-9]*"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57;"
                onpaste="setTimeout(() => { this.value = this.value.replace(/[^0-9]/g, ''); }, 0);"
            @endif

            {{ $attributes->merge(['class' => "$baseClass $borderClass $paddingClass"]) }}
        />

        {{-- PASSWORD TOGGLE --}}
        @if($isPassword)
            <button
                type="button"
                @click="show = !show"
                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-500 transition hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                :aria-label="show ? 'Sembunyikan password' : 'Tampilkan password'"
            >
                <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
                <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                    <line x1="2" x2="22" y1="2" y2="22"/>
                </svg>
            </button>
        @endif

        {{-- END ICON (non-password) --}}
        @if($endIcon && !$isPassword)
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-500 dark:text-gray-400">
                @if($isIconName($endIcon))
                    <x-ui.icon :name="$endIcon" size="md" />
                @else
                    {!! $endIcon !!}
                @endif
            </span>
        @endif
    </div>

    @if($hint && !$hasError)
        <p class="mt-1.5 text-xs text-gray-400 dark:text-gray-500">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>