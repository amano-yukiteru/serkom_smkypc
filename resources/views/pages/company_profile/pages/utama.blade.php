@extends('pages.company_profile.layouts.index')

@section('content')

    {{-- HERO --}}
    <section class="relative flex h-[720px] items-center justify-center overflow-hidden bg-blue-950 pb-32 pt-32 text-center text-white">
        <img src="{{ asset('storage/' . $profil->foto_sekolah) }}" alt="{{ asset('assets/smkypc.jpeg') }}" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-blue-950/70"></div>

        <div class="relative mx-auto w-full max-w-3xl px-4" data-aos="fade-up" data-aos-duration="900">
            <p class="font-medium text-sky-200">Yayasan Pesantren Cintawana</p>
            <h1 class="mt-4 text-4xl font-bold leading-tight tracking-tight md:text-5xl lg:text-6xl">
                {{ $profil?->nama_sekolah ?? 'SMK YPC Tasikmalaya' }}
            </h1>
            <p class="mx-auto mt-5 max-w-lg text-lg text-sky-100">Mencetak generasi siap kerja dan berakhlak mulia.</p>
            <a href="#tentang" class="mt-9 inline-block rounded-full bg-white px-8 py-3 text-sm font-semibold text-blue-900 shadow-lg transition hover:bg-sky-50">
                Tentang {{ $profil->nama_sekolah }}
            </a>
        </div>
    </section>

    {{-- STATISTIK --}}
    <section class="bg-sky-50 py-14">
        <div class="mx-auto grid max-w-6xl grid-cols-2 gap-4 px-4 md:gap-6 lg:grid-cols-4">
            <div class="flex flex-col items-center justify-between rounded-2xl bg-white px-6 py-10 text-center shadow-xl shadow-gray-300 transition hover:shadow-blue-100" data-aos="fade-up">
                <p class="mb-4 text-sm font-semibold uppercase tracking-wider text-slate-500">Akreditasi</p>
                <p class="text-5xl font-bold text-blue-900">A</p>
            </div>
            <div class="flex flex-col items-center justify-between rounded-2xl bg-white px-6 py-10 text-center shadow-xl shadow-gray-300 transition hover:shadow-blue-100" data-aos="fade-up" data-aos-delay="100">
                <p class="mb-4 text-sm font-semibold uppercase tracking-wider text-slate-500">Jumlah Siswa</p>
                <p class="text-5xl font-bold text-blue-900">{{ $totalSiswa }}</p>
            </div>
            <div class="flex flex-col items-center justify-between rounded-2xl bg-white px-6 py-10 text-center shadow-xl shadow-gray-300 transition hover:shadow-blue-100" data-aos="fade-up" data-aos-delay="200">
                <p class="mb-4 text-sm font-semibold uppercase tracking-wider text-slate-500">Jumlah Guru</p>
                <p class="text-5xl font-bold text-blue-900">{{ $totalGuru }}</p>
            </div>
            <div class="flex flex-col items-center justify-between rounded-2xl bg-white px-6 py-10 text-center shadow-xl shadow-gray-300 transition hover:shadow-blue-100" data-aos="fade-up" data-aos-delay="300">
                <p class="mb-4 text-sm font-semibold uppercase tracking-wider text-slate-500">Jumlah Jurusan</p>
                <p class="text-5xl font-bold text-blue-900">{{ $totaljurusan }}</p>
            </div>
        </div>
    </section>

    {{-- SAMBUTAN --}}
    @if($profil)
        <section id="tentang" class="scroll-mt-20 py-10 md:py-14">
            <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 md:grid-cols-5 md:gap-16">
                <div class="mx-auto w-full max-w-xs md:col-span-2" data-aos="fade-right">
                    <div class="aspect-[3/4] overflow-hidden rounded-xl bg-sky-100 shadow-lg">
                        @if($profil->foto && Storage::disk('public')->exists($profil->foto))
                            <img src="{{ asset('storage/' . $profil->foto) }}" alt="{{ $profil->kepala_sekolah }}" class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full items-center justify-center text-6xl font-bold text-sky-300">
                                {{ strtoupper(substr($profil->kepala_sekolah ?? 'K', 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-3" data-aos="fade-left">
                    <p class="text-sm font-semibold tracking-wide">Komitmen Kami untuk Pendidikan</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-blue-900 md:text-4xl">Sambutan Kepala Sekolah</h2>
                    <p class="mt-6 leading-relaxed text-slate-600">Puji syukur ke hadirat Tuhan YME atas segala rahmat dan karunia-Nya. Selamat datang di website resmi sekolah kami. Website ini kami hadirkan sebagai sarana informasi dan komunikasi antara sekolah dengan orang tua, peserta didik, serta masyarakat luas.</p>
                    <p class="mt-4 leading-relaxed text-slate-600">Melalui media ini, kami berharap seluruh informasi mengenai kegiatan, prestasi, serta program pendidikan dapat tersampaikan secara transparan, cepat, dan akurat.</p>
                    <div class="mt-8 border-t border-slate-200 pt-5">
                        <p class="text-xl font-bold text-slate-800">{{ $profil->kepala_sekolah }}</p>
                        <p class="text-sm text-slate-500">Kepala Sekolah</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- VISI & MISI --}}
    @if($profil && ($profil->visi || $profil->misi))
        <section id="visi-misi" class="scroll-mt-20 bg-sky-50 py-10 md:py-14">
            <div class="mx-auto max-w-6xl px-4">
                <div class="mb-10 text-center" data-aos="fade-up">
                    <h2 class="text-3xl font-bold tracking-tight text-blue-950 md:text-4xl">Visi &amp; Misi</h2>
                    <p class="mx-auto mt-3 max-w-2xl text-slate-600">Arah dan komitmen kami dalam menyelenggarakan pendidikan.</p>
                </div>
                <div class="grid gap-6 md:grid-cols-2">
                    @if($profil->visi)
                        <div class="rounded-2xl border border-slate-100 bg-white p-8 shadow-md" data-aos="fade-up">
                            <h3 class="text-2xl font-bold text-blue-950">Visi</h3>
                            <p class="mt-3 leading-relaxed text-slate-600">{{ $profil->visi }}</p>
                        </div>
                    @endif
                    @if($profil->misi)
                        <div class="rounded-2xl border border-slate-100 bg-white p-8 shadow-md" data-aos="fade-up" data-aos-delay="150">
                            <h3 class="text-2xl font-bold text-blue-950">Misi</h3>
                            <div class="mt-3 leading-relaxed text-slate-600">{!! nl2br(e($profil->misi)) !!}</div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- BERITA --}}
    @if($beritaTerbaru->isNotEmpty())
        <section id="berita" class="scroll-mt-20 py-10 md:py-14">
            <div class="mx-auto max-w-6xl px-4">
                <div class="mb-10 flex items-end justify-between gap-4" data-aos="fade-up">
                    <h2 class="text-3xl font-bold tracking-tight text-blue-950 md:text-4xl">Berita Terbaru</h2>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($beritaTerbaru as $item)
                        <a href="{{ route('publik.berita.detail', $item->id) }}"
                            class="group overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md transition hover:shadow-lg"
                            data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                            <div class="relative aspect-video overflow-hidden bg-sky-100">
                                @if($item->gambar && Storage::disk('public')->exists($item->gambar))
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @endif
                                <span class="absolute left-3 top-3 rounded-md bg-white/90 px-2.5 py-1 text-xs font-semibold text-blue-900 shadow-sm">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <div class="p-6">
                                <h3 class="line-clamp-2 text-lg font-bold text-blue-950 group-hover:text-sky-700">{{ $item->judul }}</h3>
                                <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-slate-600">{{ Str::limit(strip_tags($item->isi), 100) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- JURUSAN --}}

    @if($jurusans->isNotEmpty())
        <section id="jurusan" class="scroll-mt-20 bg-sky-50 py-10 md:py-14">
            <div class="mx-auto max-w-6xl px-4">
                <div class="mb-10 flex items-end justify-between gap-4" data-aos="fade-up">
                    <h2 class="text-3xl font-bold tracking-tight text-blue-950 md:text-4xl">Jurusan</h2>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($jurusans as $item)
                        <div class="group overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md transition hover:shadow-lg"
                            data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">

                            <div class="relative aspect-video overflow-hidden bg-sky-100">
                                @if($item->logo && Storage::disk('public')->exists($item->logo))
                                    <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->nama }}"
                                        class="h-full w-full object-contain p-4">
                                @else
                                    <div class="flex h-full items-center justify-center text-4xl font-bold text-sky-300">
                                        {{ strtoupper($item->singkatan) }}
                                    </div>
                                @endif

                                {{-- BADGE SINGKATAN DI KIRI ATAS --}}
                                <span class="absolute left-3 top-3 rounded-md bg-blue-900/90 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                                    {{ $item->singkatan }}
                                </span>
                            </div>

                            <div class="p-6">
                                <h3 class="text-lg font-bold text-blue-950 group-hover:text-sky-700">{{ $item->nama }}</h3>
                                {{-- <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-slate-600">
                                    {{ Str::limit(strip_tags($item->deskripsi), 100) }}
                                </p> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- KERJASAMA --}}
    @if($kerjasamas->isNotEmpty())
        <section id="kerjasama" class="scroll-mt-20 py-10 md:py-14">
            <div class="mx-auto max-w-6xl px-4">
                <div class="mb-10 text-center" data-aos="fade-up">
                    <h2 class="text-3xl font-bold tracking-tight text-blue-950 md:text-4xl">Kerjasama</h2>
                    <p class="mx-auto mt-3 max-w-2xl text-slate-600">Kami bekerja sama dengan berbagai perusahaan dan institusi terpercaya.</p>
                </div>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                    @foreach($kerjasamas as $item)
                        <div class="flex h-28 items-center justify-center rounded-xl border border-slate-100 bg-white p-4 shadow-md transition hover:shadow-lg"
                            data-aos="fade-up" data-aos-delay="{{ ($loop->index % 5) * 100 }}">
                            @if($item->foto && Storage::disk('public')->exists($item->foto))
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_perusahaan }}" class="h-full w-full object-contain">
                            @else
                                <p class="text-center text-sm font-semibold text-slate-500">{{ $item->nama_perusahaan }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- EKSTRAKURIKULER --}}
    @if($ekstrakurikuler->isNotEmpty())
        <section id="ekstrakurikuler" class="scroll-mt-20 bg-sky-50 py-10 md:py-14">
            <div class="mx-auto max-w-6xl px-4">
                <div class="mb-10 flex items-end justify-between gap-4" data-aos="fade-up">
                    <h2 class="text-3xl font-bold tracking-tight text-blue-950 md:text-4xl">Ekstrakurikuler</h2>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($ekstrakurikuler as $item)
                        <div class="rounded-xl border border-slate-100 bg-white p-6 shadow-md transition hover:shadow-lg"
                            data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-900 text-sm font-bold text-white">
                                {{ strtoupper(substr($item->nama_eskul, 0, 2)) }}
                            </div>
                            <h3 class="mt-4 text-lg font-bold text-blue-950">{{ $item->nama_eskul }}</h3>
                            <p class="mt-2 text-sm text-slate-600">Pembina: {{ $item->pembina }}</p>
                            <p class="text-sm text-slate-600">Jadwal: {{ $item->jadwal_latihan }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- GALERI --}}
    @if($galeris->isNotEmpty())
        <section id="galeri" class="scroll-mt-20 py-10 md:py-14">
            <div class="mx-auto max-w-6xl px-4">
                <div class="mb-10 flex items-end justify-between gap-4" data-aos="fade-up">
                    <h2 class="text-3xl font-bold tracking-tight text-blue-950 md:text-4xl">Galeri</h2>
                </div>

                <div class="grid grid-cols-2 gap-3 md:grid-cols-4 md:gap-4">
                    @foreach($galeris as $item)
                        @php
                            $isVideo = in_array(strtolower(pathinfo($item->file, PATHINFO_EXTENSION)), ['mp4', 'webm', 'mov']);
                            $fileUrl = asset('storage/' . $item->file);
                        @endphp

                        @if($item->file && Storage::disk('public')->exists($item->file))
                            @if($isVideo)
                                {{-- VIDEO: klik untuk buka di tab baru --}}
                                <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer"
                                    class="group relative aspect-square overflow-hidden rounded-lg bg-sky-100 shadow-md block"
                                    data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                                    <video src="{{ $fileUrl }}" class="h-full w-full object-cover" muted preload="metadata"></video>

                                    {{-- Overlay tombol play --}}
                                    <div class="absolute inset-0 flex items-center justify-center bg-blue-950/40 transition group-hover:bg-blue-950/60">
                                        <span class="flex h-14 w-14 items-center justify-center rounded-full bg-white pl-1 text-xl text-blue-900 shadow-lg">&#9654;</span>
                                    </div>

                                    {{-- Judul di bawah --}}
                                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-blue-950/90 to-transparent p-3">
                                        <p class="line-clamp-1 text-xs font-semibold text-white">{{ $item->judul }}</p>
                                    </div>
                                </a>
                            @else
                                {{-- FOTO: klik untuk buka full di tab baru --}}
                                <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer"
                                    class="group relative aspect-square overflow-hidden rounded-lg bg-sky-100 shadow-md block"
                                    data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                                    <img src="{{ $fileUrl }}" alt="{{ $item->judul }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                                    {{-- Judul di bawah --}}
                                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-blue-950/90 to-transparent p-3 opacity-0 transition group-hover:opacity-100">
                                        <p class="line-clamp-1 text-xs font-semibold text-white">{{ $item->judul }}</p>
                                    </div>
                                </a>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- GURU --}}
    @if($gurus->isNotEmpty())
        <section id="guru" class="scroll-mt-20 bg-sky-50 py-10 md:py-14">
            <div class="mx-auto max-w-6xl px-4">
                <div class="mb-10 flex items-end justify-between gap-4" data-aos="fade-up">
                    <h2 class="text-3xl font-bold tracking-tight text-blue-950 md:text-4xl">Guru &amp; Staf</h2>
                </div>
                <div class="grid grid-cols-2 gap-x-6 gap-y-10 lg:grid-cols-4">
                    @foreach($gurus as $item)
                        <div data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                            <div class="aspect-[3/4] overflow-hidden rounded-xl bg-sky-100 shadow-md">
                                @if($item->foto && Storage::disk('public')->exists($item->foto))
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_guru }}" class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full items-center justify-center text-5xl font-bold text-sky-300">
                                        {{ strtoupper(substr($item->nama_guru, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <h3 class="mt-4 line-clamp-2 text-center text-base font-bold text-blue-950">{{ $item->nama_guru }}</h3>
                            <p class="mt-1 text-center text-sm text-slate-500">{{ $item->mapel }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection