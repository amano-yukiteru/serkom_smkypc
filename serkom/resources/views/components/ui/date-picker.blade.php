@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'type' => 'date',   // date | month | year | time
    'step' => 30,        // interval menit untuk type=time: 15, 30, 60
])

@php
    $hasError = $errors->has($name);
    $oldValue = old($name, $value);
    $placeholder = $placeholder ?? match ($type) {
        'month' => 'bulan/yyyy',
        'year'  => 'yyyy',
        'time'  => 'Pilih jam',
        default => 'dd/mm/yyyy',
    };
    $todayLabel = match ($type) {
        'month' => 'Bulan ini',
        'year'  => 'Tahun ini',
        'time'  => 'Sekarang',
        default => 'Hari ini',
    };
@endphp

<div
    class="w-full"
    x-data="{
        type: @js($type),
        step: @js($step),
        open: false,
        cursor: new Date(),
        selected: null,
        selectedTime: @js($type === 'time' ? $oldValue : null),
        months: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
        week: ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

        init() {
            const raw = @js($oldValue);
            if (!raw) return;

            if (this.type === 'time') {
                this.selectedTime = raw;
                return;
            }

            let d = null;
            if (this.type === 'year') {
                const y = parseInt(raw, 10);
                if (y) d = new Date(y, 0, 1);
            } else if (this.type === 'month') {
                const [y, m] = raw.split('-').map(Number);
                if (y && m) d = new Date(y, m - 1, 1);
            } else {
                const [y, m, dd] = raw.split('-').map(Number);
                if (y && m && dd) d = new Date(y, m - 1, dd);
            }
            if (d) {
                this.selected = d;
                this.cursor = new Date(d);
            }
        },

        // === Time helpers ===
        get times() {
            const arr = [];
            for (let h = 0; h < 24; h++) {
                for (let m = 0; m < 60; m += this.step) {
                    const hh = String(h).padStart(2, '0');
                    const mm = String(m).padStart(2, '0');
                    arr.push({ value: hh + ':' + mm, label: hh + ':' + mm });
                }
            }
            return arr;
        },

        pickTime(val) {
            this.selectedTime = val;
            this.open = false;
        },

        pickNow() {
            const now = new Date();
            const hh = String(now.getHours()).padStart(2, '0');
            const mm = String(now.getMinutes()).padStart(2, '0');
            this.selectedTime = hh + ':' + mm;
            this.open = false;
        },

        // === Date helpers ===
        get headerLabel() {
            if (this.type === 'year') {
                const base = this.cursor.getFullYear();
                const start = base - (base % 12);
                return start + ' - ' + (start + 11);
            }
            if (this.type === 'month') {
                return '' + this.cursor.getFullYear();
            }
            return this.months[this.cursor.getMonth()] + ' ' + this.cursor.getFullYear();
        },

        get days() {
            const y = this.cursor.getFullYear();
            const m = this.cursor.getMonth();
            const first = new Date(y, m, 1);
            const startOffset = first.getDay();
            const daysInMonth = new Date(y, m + 1, 0).getDate();
            const daysInPrev = new Date(y, m, 0).getDate();
            const today = new Date();
            const cells = [];

            for (let i = startOffset - 1; i >= 0; i--) {
                cells.push({ d: daysInPrev - i, cur: false });
            }
            for (let d = 1; d <= daysInMonth; d++) {
                cells.push({ d, cur: true });
            }
            while (cells.length % 7 !== 0 || cells.length < 42) {
                cells.push({ d: cells.length - startOffset - daysInMonth + 1, cur: false });
            }

            return cells.map(c => {
                const isToday = c.cur && c.d === today.getDate()
                    && m === today.getMonth() && y === today.getFullYear();
                const isSel = c.cur && this.selected
                    && c.d === this.selected.getDate()
                    && m === this.selected.getMonth()
                    && y === this.selected.getFullYear();
                return { ...c, isToday, isSel };
            });
        },

        get monthCells() {
            const y = this.cursor.getFullYear();
            const today = new Date();
            return this.months.map((label, m) => ({
                label: label.slice(0, 3),
                m,
                isToday: m === today.getMonth() && y === today.getFullYear(),
                isSel: !!this.selected && m === this.selected.getMonth() && y === this.selected.getFullYear(),
            }));
        },

        get yearCells() {
            const base = this.cursor.getFullYear();
            const start = base - (base % 12);
            const today = new Date();
            return Array.from({ length: 12 }, (_, i) => {
                const y = start + i;
                return {
                    label: '' + y,
                    y,
                    isToday: y === today.getFullYear(),
                    isSel: !!this.selected && y === this.selected.getFullYear(),
                };
            });
        },

        get formattedDate() {
            if (!this.selected) return null;
            const dd = String(this.selected.getDate()).padStart(2, '0');
            const mm = String(this.selected.getMonth() + 1).padStart(2, '0');
            if (this.type === 'year') return '' + this.selected.getFullYear();
            if (this.type === 'month') return this.selected.getFullYear() + '-' + mm;
            return this.selected.getFullYear() + '-' + mm + '-' + dd;
        },

        get displayDate() {
            if (this.type === 'time') return this.selectedTime;
            if (!this.selected) return null;
            const dd = String(this.selected.getDate()).padStart(2, '0');
            const mm = String(this.selected.getMonth() + 1).padStart(2, '0');
            if (this.type === 'year') return '' + this.selected.getFullYear();
            if (this.type === 'month') return this.months[this.selected.getMonth()] + ' ' + this.selected.getFullYear();
            return dd + '/' + mm + '/' + this.selected.getFullYear();
        },

        get finalValue() {
            if (this.type === 'time') return this.selectedTime;
            return this.formattedDate;
        },

        prevMonth() { this.cursor = new Date(this.cursor.getFullYear(), this.cursor.getMonth() - 1, 1); },
        nextMonth() { this.cursor = new Date(this.cursor.getFullYear(), this.cursor.getMonth() + 1, 1); },
        prevYear() { this.cursor = new Date(this.cursor.getFullYear() - 1, 0, 1); },
        nextYear() { this.cursor = new Date(this.cursor.getFullYear() + 1, 0, 1); },
        prevDecade() { this.cursor = new Date(this.cursor.getFullYear() - 12, 0, 1); },
        nextDecade() { this.cursor = new Date(this.cursor.getFullYear() + 12, 0, 1); },

        prev() {
            if (this.type === 'date') this.prevMonth();
            else if (this.type === 'month') this.prevYear();
            else this.prevDecade();
        },
        next() {
            if (this.type === 'date') this.nextMonth();
            else if (this.type === 'month') this.nextYear();
            else this.nextDecade();
        },

        pick(day) {
            this.selected = new Date(this.cursor.getFullYear(), this.cursor.getMonth(), day);
            this.open = false;
        },
        pickMonth(m) {
            this.selected = new Date(this.cursor.getFullYear(), m, 1);
            this.open = false;
        },
        pickYear(y) {
            this.selected = new Date(y, 0, 1);
            this.open = false;
        },

        pickToday() {
            if (this.type === 'time') {
                this.pickNow();
                return;
            }
            const now = new Date();
            this.cursor = new Date(now);
            this.selected = new Date(now);
            this.open = false;
        },
    }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
>
    {{-- Label --}}
    @if($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    {{-- Tombol input --}}
    <div class="relative">
        <button
            type="button"
            id="{{ $name }}"
            @click="open = !open"
            class="flex h-11 w-full items-center justify-between gap-2 rounded-lg border bg-transparent px-4 text-left text-sm text-gray-800
                   shadow-theme-xs outline-hidden transition focus:ring-3
                   dark:bg-gray-900 dark:text-white/90
                   {{ $hasError
                       ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10 dark:border-red-500'
                       : 'border-gray-300 focus:border-indigo-300 focus:ring-indigo-500/10 dark:border-gray-700 dark:focus:border-indigo-800' }}"
        >
            <span
                :class="displayDate ? 'text-gray-800 dark:text-white/90' : 'text-gray-400 dark:text-gray-500'"
                x-text="displayDate || '{{ $placeholder }}'"
            ></span>

            {{-- Icon: kalender atau jam --}}
            @if($type === 'time')
                <svg class="h-4 w-4 shrink-0 text-gray-500 dark:text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"/>
                    <polyline points="12 7 12 12 15 14"/>
                </svg>
            @else
                <svg class="h-4 w-4 shrink-0 text-gray-500 dark:text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            @endif
        </button>

        {{-- Panel --}}
        <div
            x-show="open"
            x-cloak
            x-transition
            class="absolute z-50 mt-2 w-full rounded-lg border border-gray-300 bg-white p-4 shadow-xl dark:border-gray-700 dark:bg-gray-900"
        >
            {{-- ==================== TIME ==================== --}}
            <template x-if="type === 'time'">
                <div>
                    <div class="mb-3 flex items-center justify-between">
                        <span class="text-sm font-semibold text-gray-800 dark:text-white">Pilih Jam</span>
                        <button type="button" @click="selectedTime = null; open = false"
                                class="text-xs text-gray-400 hover:text-red-500">Clear</button>
                    </div>

                    <div class="grid max-h-64 grid-cols-4 gap-1 overflow-y-auto">
                        <template x-for="t in times" :key="t.value">
                            <button
                                type="button"
                                @click="pickTime(t.value)"
                                class="rounded-md py-1.5 text-center text-xs font-medium transition"
                                :class="{
                                    'bg-indigo-600 text-white': selectedTime === t.value,
                                    'text-gray-700 hover:bg-indigo-50 dark:text-gray-300 dark:hover:bg-indigo-500/10': selectedTime !== t.value,
                                }"
                                x-text="t.label"
                            ></button>
                        </template>
                    </div>
                </div>
            </template>

            {{-- ==================== DATE / MONTH / YEAR ==================== --}}
            <template x-if="type !== 'time'">
                <div>
                    {{-- Header --}}
                    <div class="mb-3 flex items-center justify-between">
                        <button type="button" @click="prev()"
                                class="flex h-7 w-7 items-center justify-center rounded-md text-gray-500 hover:bg-indigo-50 hover:text-indigo-600 dark:text-gray-400 dark:hover:bg-indigo-500/10">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                                <path d="M12 15 7 10l5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <span class="text-sm font-semibold text-gray-800 dark:text-white" x-text="headerLabel"></span>

                        <button type="button" @click="next()"
                                class="flex h-7 w-7 items-center justify-center rounded-md text-gray-500 hover:bg-indigo-50 hover:text-indigo-600 dark:text-gray-400 dark:hover:bg-indigo-500/10">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                                <path d="m8 15 5-5-5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Grid tanggal --}}
                    <template x-if="type === 'date'">
                        <div>
                            <div class="mb-1 grid grid-cols-7">
                                <template x-for="d in week" :key="d">
                                    <div class="py-1 text-center text-[11px] font-medium text-gray-400 dark:text-gray-500" x-text="d"></div>
                                </template>
                            </div>
                            <div class="grid grid-cols-7 gap-y-1">
                                <template x-for="(c, i) in days" :key="i">
                                    <button type="button" @click="c.cur && pick(c.d)" :disabled="!c.cur"
                                        class="mx-auto flex aspect-square w-full max-w-[32px] items-center justify-center rounded-full text-sm transition"
                                        :class="{
                                            'bg-indigo-600 text-white': c.isSel,
                                            'text-gray-800 dark:text-gray-100 hover:bg-indigo-50 dark:hover:bg-indigo-500/10': c.cur && !c.isSel,
                                            'text-gray-300 dark:text-gray-600 cursor-default': !c.cur,
                                            'ring-2 ring-inset ring-indigo-500': c.isToday && !c.isSel,
                                        }"
                                        x-text="c.d"></button>
                                </template>
                            </div>
                        </div>
                    </template>

                    {{-- Grid bulan --}}
                    <template x-if="type === 'month'">
                        <div class="grid grid-cols-3 gap-2">
                            <template x-for="(c, i) in monthCells" :key="i">
                                <button type="button" @click="pickMonth(c.m)"
                                    class="rounded-lg py-2 text-sm font-medium transition"
                                    :class="{
                                        'bg-indigo-600 text-white': c.isSel,
                                        'text-gray-800 dark:text-gray-100 hover:bg-indigo-50 dark:hover:bg-indigo-500/10': !c.isSel,
                                        'ring-2 ring-inset ring-indigo-500': c.isToday && !c.isSel,
                                    }"
                                    x-text="c.label"></button>
                            </template>
                        </div>
                    </template>

                    {{-- Grid tahun --}}
                    <template x-if="type === 'year'">
                        <div class="grid grid-cols-3 gap-2">
                            <template x-for="(c, i) in yearCells" :key="i">
                                <button type="button" @click="pickYear(c.y)"
                                    class="rounded-lg py-2 text-sm font-medium transition"
                                    :class="{
                                        'bg-indigo-600 text-white': c.isSel,
                                        'text-gray-800 dark:text-gray-100 hover:bg-indigo-50 dark:hover:bg-indigo-500/10': !c.isSel,
                                        'ring-2 ring-inset ring-indigo-500': c.isToday && !c.isSel,
                                    }"
                                    x-text="c.label"></button>
                            </template>
                        </div>
                    </template>

                    {{-- Footer --}}
                    <div class="mt-3 flex items-center justify-between border-t border-gray-100 pt-3 dark:border-gray-700">
                        <button type="button" @click="pickToday()"
                                class="text-xs font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400">
                            {{ $todayLabel }}
                        </button>
                        <button type="button" @click="open = false"
                                class="text-xs font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400">
                            Tutup
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Hidden input --}}
    <input type="hidden" name="{{ $name }}" :value="finalValue" @if($required) required @endif>

    @error($name)
        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>