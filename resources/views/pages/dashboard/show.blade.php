@extends('layouts.app')

@section('title', 'UI Component Showcase')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">UI Component Showcase</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Preview semua komponen <code class="rounded bg-gray-100 px-1.5 py-0.5 text-xs dark:bg-gray-800">&lt;x-ui.*&gt;</code>
        </p>
    </div>

    {{-- ==================== BREADCRUMB ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/breadcrumb.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Breadcrumb</h3>
            <div class="space-y-4">
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-gray-400">1 Level</p>
                    <x-ui.breadcrumb :items="[['label' => 'Dashboard']]" />
                </div>
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-gray-400">2 Level</p>
                    <x-ui.breadcrumb :items="[
                        ['label' => 'Siswa', 'url' => '#'],
                        ['label' => 'Tambah Siswa'],
                    ]" />
                </div>
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-gray-400">3 Level</p>
                    <x-ui.breadcrumb :items="[
                        ['label' => 'Data Master', 'url' => '#'],
                        ['label' => 'Siswa', 'url' => '#'],
                        ['label' => 'Edit Siswa'],
                    ]" />
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== CARD ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/card.blade.php
        </p>
        <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Card</h3>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-ui.card>
                <h4 class="text-sm font-semibold text-gray-800 dark:text-white/90">Card Default</h4>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Card dengan padding bawaan (p-5 sm:p-6). Cocok untuk konten biasa.
                </p>
            </x-ui.card>

            <x-ui.card :padding="false">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-700">
                    <h4 class="text-sm font-semibold text-gray-800 dark:text-white/90">Card Tanpa Padding</h4>
                </div>
                <div class="p-5">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Konten dengan header terpisah. Cocok untuk tabel atau list dengan header.
                    </p>
                </div>
            </x-ui.card>

            <x-ui.card class="!border-indigo-200 !bg-indigo-50/50 dark:!border-indigo-500/30 dark:!bg-indigo-500/5">
                <h4 class="text-sm font-semibold text-indigo-700 dark:text-indigo-400">Card Berwarna</h4>
                <p class="mt-2 text-sm text-indigo-600/80 dark:text-indigo-300/80">
                    Pakai class kustom untuk override border & background.
                </p>
            </x-ui.card>

            <x-ui.card class="hover:shadow-lg transition">
                <h4 class="text-sm font-semibold text-gray-800 dark:text-white/90">Card dengan Hover</h4>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Atribut HTML tambahan akan otomatis di-merge.
                </p>
            </x-ui.card>
        </div>
    </div>

    {{-- ==================== ALERT ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/alert.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Alert</h3>
            <div class="space-y-3">
                <x-ui.alert type="info">Ini alert informasi.</x-ui.alert>
                <x-ui.alert type="success">Data berhasil disimpan.</x-ui.alert>
                <x-ui.alert type="warning">Perhatian, stok hampir habis.</x-ui.alert>
                <x-ui.alert type="danger" title="Terjadi Kesalahan" message="Sistem tidak dapat memproses permintaan." />
                <x-ui.alert type="info" dismissible>Alert yang bisa ditutup.</x-ui.alert>
                <x-ui.alert
                    type="warning"
                    title="Peringatan"
                    message="Kuota penyimpanan hampir penuh."
                    :showLink="true"
                    linkHref="#"
                    linkText="Kelola Penyimpanan"
                />
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== BADGE ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/badge.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Badge</h3>
            <div class="space-y-4">
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-gray-400">Light</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <x-ui.badge>Default</x-ui.badge>
                        <x-ui.badge variant="primary">Primary</x-ui.badge>
                        <x-ui.badge variant="success">Success</x-ui.badge>
                        <x-ui.badge variant="warning">Warning</x-ui.badge>
                        <x-ui.badge variant="danger">Danger</x-ui.badge>
                        <x-ui.badge variant="info">Info</x-ui.badge>
                    </div>
                </div>
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-gray-400">Solid</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <x-ui.badge style="solid">Default</x-ui.badge>
                        <x-ui.badge variant="primary" style="solid">Primary</x-ui.badge>
                        <x-ui.badge variant="success" style="solid">Success</x-ui.badge>
                        <x-ui.badge variant="warning" style="solid">Warning</x-ui.badge>
                        <x-ui.badge variant="danger" style="solid">Danger</x-ui.badge>
                        <x-ui.badge variant="info" style="solid">Info</x-ui.badge>
                    </div>
                </div>
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-gray-400">Size</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <x-ui.badge variant="primary" size="sm">Small</x-ui.badge>
                        <x-ui.badge variant="primary" size="md">Medium</x-ui.badge>
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== BUTTON ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/button.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Button</h3>
            <div class="space-y-5">
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-gray-400">Variant</p>
                    <div class="flex flex-wrap gap-2">
                        <x-ui.button>Primary</x-ui.button>
                        <x-ui.button variant="secondary">Secondary</x-ui.button>
                        <x-ui.button variant="success">Success</x-ui.button>
                        <x-ui.button variant="danger">Danger</x-ui.button>
                        <x-ui.button variant="outline">Outline</x-ui.button>
                    </div>
                </div>
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-gray-400">Size</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <x-ui.button size="sm">Small</x-ui.button>
                        <x-ui.button size="md">Medium</x-ui.button>
                        <x-ui.button size="lg">Large</x-ui.button>
                    </div>
                </div>
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-gray-400">State</p>
                    <div class="flex flex-wrap gap-2">
                        <x-ui.button href="#">Link Button</x-ui.button>
                        <x-ui.button :disabled="true">Disabled</x-ui.button>
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== STAT CARDS ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/stat-card.blade.php
            &nbsp;|&nbsp;
            📄 resources/views/components/ui/stat-grid.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Stat Cards</h3>

            <p class="mb-3 text-xs font-semibold uppercase text-gray-400">4 Kartu</p>
            <x-ui.stat-grid>
                <x-ui.stat-card
                    label="Customers"
                    value="3,782"
                    trend="11.01"
                    :icon="'<svg class=\'h-5 w-5\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\' stroke-width=\'1.8\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z\'/></svg>'"
                />
                <x-ui.stat-card
                    label="Orders"
                    value="5,359"
                    trend="-9.05"
                    :icon="'<svg class=\'h-5 w-5\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\' stroke-width=\'1.8\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4\'/></svg>'"
                />
                <x-ui.stat-card
                    label="Revenue"
                    value="Rp 45.2M"
                    trend="24.5"
                    :icon="'<svg class=\'h-5 w-5\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\' stroke-width=\'1.8\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z\'/></svg>'"
                />
                <x-ui.stat-card
                    label="Products"
                    value="1,250"
                    trend="3.2"
                    :icon="'<svg class=\'h-5 w-5\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\' stroke-width=\'1.8\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4\'/></svg>'"
                />
            </x-ui.stat-grid>

            <div class="mt-6">
                <p class="mb-3 text-xs font-semibold uppercase text-gray-400">3 Kartu</p>
                <x-ui.stat-grid>
                    <x-ui.stat-card label="Total Siswa" value="150" trend="5.2" />
                    <x-ui.stat-card label="Total Guru" value="25" trend="0" />
                    <x-ui.stat-card label="Total Kelas" value="12" trend="-2.1" />
                </x-ui.stat-grid>
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== NEWS CARD ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/news-card.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">News Card</h3>

            <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Dengan Gambar & Metadata</p>
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <x-ui.news-card
                    image="https://picsum.photos/seed/berita1/400/240"
                    title="Kegiatan Class Meeting 2024 Berlangsung Meriah"
                    excerpt="Berbagai lomba diadakan untuk mengisi waktu setelah ujian semester ganjil."
                    date="15 Jan 2024"
                    author="Ahmad Fauzi"
                    editHref="#"
                    deleteModal="demo-news-delete-0"
                />
                <x-ui.news-card
                    image="https://picsum.photos/seed/berita2/400/240"
                    title="Kunjungan Industri ke PT. Teknologi Nusantara"
                    excerpt="Siswa kelas XI mengunjungi pabrik teknologi untuk belajar langsung dari ahlinya."
                    date="12 Jan 2024"
                    author="Siti Aminah"
                    editHref="#"
                    deleteModal="demo-news-delete-1"
                />
                <x-ui.news-card
                    image="https://picsum.photos/seed/berita3/400/240"
                    title="Workshop Literasi Digital untuk Guru"
                    excerpt="Meningkatkan kompetensi guru dalam menghadapi era digital."
                    date="10 Jan 2024"
                    author="Andi Wijaya"
                    editHref="#"
                    deleteModal="demo-news-delete-2"
                />
            </div>

            <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Tanpa Gambar (fallback icon)</p>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <x-ui.news-card
                    :image="null"
                    title="Pengumuman Libur Semester"
                    excerpt="Libur semester akan dimulai tanggal 20 Januari 2024 hingga 5 Februari 2024."
                    date="08 Jan 2024"
                    author="Administrator"
                    editHref="#"
                />
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== ICON ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/icon.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Icon</h3>

            <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Size</p>
            <div class="mb-6 flex flex-wrap items-center gap-4 text-gray-700 dark:text-gray-300">
                <x-ui.icon name="search" size="sm" />
                <x-ui.icon name="search" size="md" />
                <x-ui.icon name="search" size="lg" />
            </div>

            <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Warna</p>
            <div class="mb-6 flex flex-wrap items-center gap-4">
                <x-ui.icon name="check" class="text-emerald-500" />
                <x-ui.icon name="alert" class="text-amber-500" />
                <x-ui.icon name="x" class="text-red-500" />
                <x-ui.icon name="info" class="text-blue-500" />
                <x-ui.icon name="search" class="text-indigo-500" />
            </div>

            <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Daftar Icon</p>
            <div class="grid grid-cols-4 gap-4 text-gray-700 dark:text-gray-300 sm:grid-cols-6 md:grid-cols-8">
                @foreach(['search','filter','menu','close','chevron-down','chevron-up','chevron-left','chevron-right','arrow-left','arrow-right','user','users','user-plus','user-check','lock','unlock','key','shield','shield-check','email','phone','message','send','bell','calendar','clock','money','cart','tag','map-pin','globe','file','file-text','folder','upload','download','edit','trash','plus','minus','check','x','refresh','save','copy','external-link','eye','eye-off','info','alert','check-circle','x-circle'] as $icon)
                    <div class="flex flex-col items-center gap-1 rounded-lg border border-gray-200 p-2 dark:border-gray-700">
                        <x-ui.icon :name="$icon" size="md" />
                        <span class="text-[10px] text-gray-400">{{ $icon }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== INPUT & TEXTAREA ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/input.blade.php
            &nbsp;|&nbsp;
            📄 resources/views/components/ui/textarea.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Input & Textarea</h3>

            <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Input Tanpa Icon</p>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <x-ui.input name="demo_text" label="Text" placeholder="Masukkan teks..." />
                <x-ui.input name="demo_email" type="email" label="Email" placeholder="email@example.com" />
                <x-ui.input name="demo_number" type="number" label="Number" placeholder="0" />
                <x-ui.input name="demo_password" type="password" label="Password" placeholder="••••••••" />
                <x-ui.input name="demo_hint" label="Dengan Hint" placeholder="..." hint="Keterangan di bawah input." />
                <x-ui.input name="demo_required" label="Required" placeholder="Wajib diisi" required />
            </div>

            <p class="mb-3 mt-6 text-xs font-semibold uppercase text-gray-400">Input Dengan Icon (pakai nama)</p>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <x-ui.input name="demo_search" label="Search" placeholder="Cari sesuatu..." startIcon="search" />
                <x-ui.input name="demo_email_icon" type="email" label="Email" placeholder="info@example.com" startIcon="email" />
                <x-ui.input name="demo_user" label="Username" placeholder="Masukkan username..." startIcon="user" />
                <x-ui.input name="demo_password_icon" type="password" label="Password (kunci + mata)" placeholder="••••••••" startIcon="lock" />
                <x-ui.input name="demo_phone" label="Telepon" placeholder="+62..." startIcon="phone" />
                <x-ui.input name="demo_tanggal" label="Tanggal" placeholder="Pilih tanggal..." endIcon="calendar" />
                <x-ui.input name="demo_harga" type="number" label="Harga" placeholder="0" startIcon="money" />
                <x-ui.input name="demo_alamat" label="Alamat" placeholder="Alamat..." startIcon="map-pin" />
            </div>

            <p class="mb-3 mt-6 text-xs font-semibold uppercase text-gray-400">Textarea</p>
            <div class="space-y-5">
                <x-ui.textarea name="demo_textarea" label="Deskripsi" placeholder="Tulis sesuatu..." rows="5" hint="Maksimal 500 karakter." />
                <x-ui.textarea name="demo_textarea_resize" label="Bisa Di-resize Vertikal" placeholder="Coba geser ke bawah..." rows="4" resize="vertical" />
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== SELECT ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/select.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Select</h3>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <x-ui.select
                    name="demo_select"
                    label="Select"
                    placeholder="Pilih opsi"
                    :options="['a' => 'Opsi A', 'b' => 'Opsi B', 'c' => 'Opsi C']"
                />
                <x-ui.select
                    name="demo_select_user"
                    label="Select dengan icon"
                    placeholder="Pilih user"
                    startIcon="user"
                    :options="['1' => 'Budi Santoso', '2' => 'Siti Aminah', '3' => 'Andi Wijaya']"
                />
                <x-ui.select
                    name="demo_select_kota"
                    label="Select dengan icon map-pin"
                    placeholder="Pilih kota"
                    startIcon="map-pin"
                    :options="['jkt' => 'Jakarta', 'bdg' => 'Bandung', 'sby' => 'Surabaya']"
                />
                <x-ui.select
                    name="demo_select_required"
                    label="Select Required"
                    placeholder="Pilih kategori"
                    required
                    :options="['Marketing' => 'Marketing', 'Template' => 'Template', 'Development' => 'Development']"
                />
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== RADIO, CHECKBOX, TOGGLE ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/radio.blade.php
            &nbsp;|&nbsp;
            📄 resources/views/components/ui/checkbox.blade.php
            &nbsp;|&nbsp;
            📄 resources/views/components/ui/toggle.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Radio, Checkbox & Toggle</h3>
            <div class="space-y-6">
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Radio</p>
                    <div class="flex flex-wrap gap-6">
                        <x-ui.radio name="demo_radio" value="l" label="Laki-laki" />
                        <x-ui.radio name="demo_radio" value="p" label="Perempuan" />
                        <x-ui.radio name="demo_radio2" value="a" label="Checked" :checked="true" />
                        <x-ui.radio name="demo_radio3" value="x" label="Disabled" disabled />
                    </div>
                </div>

                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Checkbox</p>
                    <div class="flex flex-wrap gap-6">
                        <x-ui.checkbox name="demo_check1" label="Default" />
                        <x-ui.checkbox name="demo_check2" label="Checked" :checked="true" />
                        <x-ui.checkbox name="demo_check3" label="Disabled" disabled />
                    </div>
                </div>

                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Toggle Switch</p>
                    <div class="flex flex-wrap gap-6">
                        <x-ui.toggle name="demo_toggle1" label="Default" />
                        <x-ui.toggle name="demo_toggle2" label="Checked" :checked="true" />
                        <x-ui.toggle name="demo_toggle3" label="Disabled" disabled />
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== DATE PICKER ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/date-picker.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Date Picker</h3>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <x-ui.date-picker name="demo_date" label="Tanggal" />
                <x-ui.date-picker name="demo_month" label="Bulan" type="month" />
                <x-ui.date-picker name="demo_year" label="Tahun" type="year" />
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== FILE INPUT ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/file-input.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">File Input</h3>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <x-ui.file-input
                    name="demo_file"
                    label="Upload Gambar / Video"
                    hint="Format: JPG, PNG, MP4. Maks 2MB."
                />
                <x-ui.file-input
                    name="demo_file2"
                    label="Upload Dokumen"
                    accept=".pdf,.doc,.docx"
                    hint="Format: PDF, DOC."
                />
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== DROPZONE ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/dropzone.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Dropzone</h3>
            <div class="space-y-6">
                <x-ui.dropzone
                    name="demo_dropzone1"
                    label="Upload Media (multiple)"
                    hint="Format: JPG, PNG, MP4. Maks 5MB per file."
                    :maxFiles="5"
                    :maxSize="5"
                />
                <x-ui.dropzone
                    name="demo_dropzone2"
                    label="Upload Satu File"
                    :multiple="false"
                    :maxSize="2"
                />
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== EMPTY STATE ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/empty-state.blade.php
        </p>
        <x-ui.card :padding="false">
            <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-700">
                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Empty State</h3>
            </div>
            <x-ui.empty-state
                icon="user"
                title="Belum Ada Data Siswa"
                message="Tambahkan data siswa baru untuk memulai."
                actionLabel="Tambah Siswa"
                actionHref="#"
            />
        </x-ui.card>
    </div>

    {{-- ==================== TABLE ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/table.blade.php
            &nbsp;|&nbsp;
            📄 .../ui/table/row.blade.php
            &nbsp;|&nbsp;
            📄 .../ui/table/td.blade.php
            &nbsp;|&nbsp;
            📄 .../ui/table/actions.blade.php
            &nbsp;|&nbsp;
            📄 .../ui/table/table-paginator.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Table</h3>
            @php
                $tableItems = collect([
                    (object) ['nama' => 'Budi Santoso', 'email' => 'budi@example.com',  'status' => 'success', 'label' => 'Aktif'],
                    (object) ['nama' => 'Siti Aminah',  'email' => 'siti@example.com',  'status' => 'warning', 'label' => 'Pending'],
                    (object) ['nama' => 'Andi Wijaya',  'email' => 'andi@example.com',  'status' => 'danger',  'label' => 'Nonaktif'],
                ]);

                $demoPaginator = new \Illuminate\Pagination\LengthAwarePaginator(
                    $tableItems,
                    50,
                    3,
                    2,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
            @endphp

            <x-ui.table :headers="['Nama', 'Email', 'Status', 'Aksi']" :paginator="$demoPaginator">
                @foreach($tableItems as $item)
                    <x-ui.table.row>
                        <x-ui.table.td class="font-medium">{{ $item->nama }}</x-ui.table.td>
                        <x-ui.table.td>{{ $item->email }}</x-ui.table.td>
                        <x-ui.table.td>
                            <x-ui.badge variant="{{ $item->status }}">{{ $item->label }}</x-ui.badge>
                        </x-ui.table.td>
                        <x-ui.table.td :last="true" align="center" :fit="true">
                            <x-ui.table.actions editHref="#" :deleteModal="'demo-delete-' . $loop->index" />
                        </x-ui.table.td>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table>
        </x-ui.card>
    </div>

    {{-- ==================== PAGINATION ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/pagination.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Pagination Standalone</h3>

            @php
                $makePaginator = function ($total, $perPage, $page) {
                    return new \Illuminate\Pagination\LengthAwarePaginator(
                        collect(range(1, min($total, $perPage)))->map(fn($i) => (object) ['id' => $i]),
                        $total,
                        $perPage,
                        $page,
                        ['path' => request()->url(), 'query' => request()->query()]
                    );
                };

                $paginatorDefault = $makePaginator(100, 10, 5);
                $paginatorSimple  = $makePaginator(50, 10, 2);
                $paginatorCompact = $makePaginator(200, 20, 7);
            @endphp

            <div class="space-y-6">
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">
                        Variant: default (dengan nomor halaman)
                    </p>
                    <x-ui.card :padding="false">
                        <x-ui.pagination :paginator="$paginatorDefault" variant="default" />
                    </x-ui.card>
                </div>

                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">
                        Variant: simple (cuma prev/next)
                    </p>
                    <x-ui.card :padding="false">
                        <x-ui.pagination :paginator="$paginatorSimple" variant="simple" />
                    </x-ui.card>
                </div>

                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">
                        Variant: compact (info + navigasi minimal)
                    </p>
                    <x-ui.card :padding="false">
                        <x-ui.pagination :paginator="$paginatorCompact" variant="compact" />
                    </x-ui.card>
                </div>

                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">
                        Single Page (tidak tampil jika cuma 1 halaman)
                    </p>
                    <x-ui.card :padding="false">
                        <x-ui.pagination :paginator="$makePaginator(5, 10, 1)" variant="default" />
                        <p class="px-5 py-4 text-center text-xs text-gray-400">
                            ↑ Pagination tidak muncul karena hanya 1 halaman
                        </p>
                    </x-ui.card>
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== CALENDAR AREA ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/calendar-area.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Calendar Area</h3>
            <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                Area kalender untuk menampilkan jadwal, event, atau agenda.
            </p>

            <div class="space-y-6">
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Default</p>
                    <x-calendar-area />
                </div>

                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Dengan Event (contoh)</p>
                    @php
                        $demoEvents = [
                            ['date' => now()->format('Y-m-d'), 'title' => 'Rapat Guru', 'color' => 'indigo'],
                            ['date' => now()->addDays(2)->format('Y-m-d'), 'title' => 'Class Meeting', 'color' => 'emerald'],
                            ['date' => now()->addDays(5)->format('Y-m-d'), 'title' => 'Ujian Akhir', 'color' => 'red'],
                        ];
                    @endphp
                    <x-calendar-area :events="$demoEvents" />
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== NOTIFICATION DROPDOWN ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/notification-dropdown.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Notification Dropdown</h3>
            @php
                $demoNotifications = collect([
                    ['id' => 1, 'title' => 'Ahmad Fauzi', 'message' => 'Mengirim pesan baru', 'time' => '5 menit lalu', 'read' => false, 'url' => '#'],
                    ['id' => 2, 'title' => 'Siti Aminah', 'message' => 'Menyukai postinganmu', 'time' => '1 jam lalu', 'read' => false, 'url' => '#'],
                    ['id' => 3, 'title' => 'Sistem', 'message' => 'Backup database berhasil', 'time' => '3 jam lalu', 'read' => true, 'url' => '#'],
                ]);
            @endphp

            <div class="flex flex-col gap-6">
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Dengan data</p>
                    <x-ui.notification-dropdown :notifications="$demoNotifications" markAllRoute="#" viewAllRoute="#" />
                </div>
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Empty state</p>
                    <x-ui.notification-dropdown :notifications="collect()" />
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== PROFILE DROPDOWN ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/profile-dropdown.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Profile Dropdown</h3>
            <div class="flex flex-col gap-6">
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Dengan nama</p>
                    <x-ui.profile-dropdown
                        name="Musharof Chowdhury"
                        email="musharof@tailadmin.com"
                        :showName="true"
                    />
                </div>
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase text-gray-400">Avatar saja</p>
                    <x-ui.profile-dropdown
                        name="Ahmad Fauzi"
                        email="ahmad@example.com"
                        :showName="false"
                    />
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== TOAST ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/toast.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Toast</h3>
            <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                Klik tombol di bawah untuk menampilkan toast.
            </p>
            <div class="flex flex-wrap gap-2">
                <x-ui.button
                    variant="success"
                    @click="$dispatch('toast', { type: 'success', title: 'Berhasil', message: 'Data siswa berhasil disimpan.' })"
                >
                    Success
                </x-ui.button>

                <x-ui.button
                    variant="danger"
                    @click="$dispatch('toast', { type: 'danger', title: 'Gagal', message: 'Terjadi kesalahan pada server.' })"
                >
                    Danger
                </x-ui.button>

                <x-ui.button
                    class="!bg-amber-500 hover:!bg-amber-600"
                    @click="$dispatch('toast', { type: 'warning', title: 'Perhatian', message: 'Stok data hampir habis.' })"
                >
                    Warning
                </x-ui.button>

                <x-ui.button
                    variant="secondary"
                    @click="$dispatch('toast', { type: 'info', title: 'Info', message: 'Ada update terbaru untuk sistem.' })"
                >
                    Info
                </x-ui.button>
            </div>
        </x-ui.card>
    </div>

    {{-- ==================== MODAL ==================== --}}
    <div>
        <p class="mb-2 font-mono text-xs text-gray-400 dark:text-gray-500">
            📄 resources/views/components/ui/modal.blade.php
        </p>
        <x-ui.card>
            <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white/90">Modal</h3>
            <div class="flex flex-wrap gap-2">
                <x-ui.button @click="$dispatch('open-modal-demo')">Buka Modal</x-ui.button>
                <x-ui.button variant="danger" @click="$dispatch('open-modal-demo-delete')">Konfirmasi Hapus</x-ui.button>
            </div>
        </x-ui.card>
    </div>

</div>

{{-- ==================== MODAL DEFINITIONS ==================== --}}
<x-ui.modal name="demo" title="Contoh Modal">
    <p>Ini adalah isi dari modal. Kamu bisa menaruh form atau konten apa pun di sini.</p>
    <x-slot:footer>
        <x-ui.button variant="outline" @click="$dispatch('close-modal-demo')">Tutup</x-ui.button>
        <x-ui.button @click="$dispatch('close-modal-demo')">Simpan</x-ui.button>
    </x-slot:footer>
</x-ui.modal>

<x-ui.modal name="demo-delete" title="Konfirmasi Hapus" maxWidth="sm">
    <p>Yakin ingin menghapus data ini?</p>
    <x-slot:footer>
        <x-ui.button variant="outline" @click="$dispatch('close-modal-demo-delete')">Batal</x-ui.button>
        <x-ui.button variant="danger" @click="$dispatch('close-modal-demo-delete')">Hapus</x-ui.button>
    </x-slot:footer>
</x-ui.modal>

@foreach(['demo-delete-0', 'demo-delete-1', 'demo-delete-2'] as $modalName)
    <x-ui.modal name="{{ $modalName }}" title="Konfirmasi Hapus" maxWidth="sm">
        <p>Yakin ingin menghapus data ini?</p>
        <x-slot:footer>
            <x-ui.button variant="outline" @click="$dispatch('close-modal-{{ $modalName }}')">Batal</x-ui.button>
            <x-ui.button variant="danger" @click="$dispatch('close-modal-{{ $modalName }}')">Hapus</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
@endforeach

@foreach(['demo-news-delete-0', 'demo-news-delete-1', 'demo-news-delete-2'] as $modalName)
    <x-ui.modal name="{{ $modalName }}" title="Konfirmasi Hapus" maxWidth="sm">
        <p>Yakin ingin menghapus berita ini?</p>
        <x-slot:footer>
            <x-ui.button variant="outline" @click="$dispatch('close-modal-{{ $modalName }}')">Batal</x-ui.button>
            <x-ui.button variant="danger" @click="$dispatch('close-modal-{{ $modalName }}')">Hapus</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
@endforeach

@endsection