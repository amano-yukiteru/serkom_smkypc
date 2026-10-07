<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil?->nama_sekolah ?? 'SMK YPC' }} Tasikmalaya</title>
    <link rel="icon" href="{{ asset('assets/smkypc.jpeg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-slate-800 antialiased">

    @include('pages.company_profile.header')

    <main>

        {{-- ==================== HERO ==================== --}}
        <section class="relative overflow-hidden bg-gradient-to-br from-blue-950 via-blue-900 to-sky-700 pb-40 pt-36 text-white">
            <div class="absolute -left-24 top-24 h-80 w-80 bg-sky-400/10 [clip-path:polygon(25%_0,75%_0,100%_50%,75%_100%,25%_100%,0_50%)]"></div>
            <div class="absolute -bottom-20 right-1/3 h-56 w-56 bg-amber-400/10 [clip-path:polygon(25%_0,75%_0,100%_50%,75%_100%,25%_100%,0_50%)]"></div>

            <div class="relative mx-auto grid max-w-6xl items-center gap-14 px-4 md:grid-cols-5">
                <div class="md:col-span-3" data-aos="fade-right" data-aos-duration="900">
                    <p class="font-semibold text-amber-400">Yayasan Pesantren Cintawana</p>
                    <h1 class="mt-4 text-4xl font-extrabold leading-[1.1] tracking-tight md:text-5xl lg:text-6xl">
                        {{ $profil?->nama_sekolah ?? 'SMK YPC Tasikmalaya' }}
                    </h1>
                    <p class="mt-5 max-w-lg text-lg text-sky-100">Mencetak generasi siap kerja dan berakhlak mulia.</p>
                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('login') }}" class="rounded-full bg-amber-400 px-8 py-3.5 text-center text-sm font-bold text-blue-950 transition hover:bg-amber-300">Daftar Sekarang</a>
                        <a href="#tentang" class="rounded-full border border-white/40 px-8 py-3.5 text-center text-sm font-semibold transition hover:bg-white/10">Pelajari Lebih Lanjut</a>
                    </div>
                </div>

                {{-- Logo dipotong bentuk hexagon, sama seperti bentuk logo sekolah --}}
                <div class="flex justify-center md:col-span-2 md:justify-end" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="900">
                    <div class="relative aspect-[285/245] w-64 sm:w-72 md:w-80">
                        <div class="absolute inset-0 bg-amber-400 [clip-path:polygon(25%_0,75%_0,100%_50%,75%_100%,25%_100%,0_50%)]"></div>
                        <img src="{{ asset('assets/smkypc.jpeg') }}"
                             alt="Logo {{ $profil?->nama_sekolah ?? 'SMK YPC' }}"
                             class="absolute left-[4%] top-[4%] h-[92%] w-[92%] object-contain [clip-path:polygon(25%_0,75%_0,100%_50%,75%_100%,25%_100%,0_50%)]">
                    </div>
                </div>
            </div>
        </section>

        {{-- ==================== STATISTIK ==================== --}}
        <section class="relative z-10 -mt-16 px-4">
            <div class="mx-auto grid max-w-4xl grid-cols-3 divide-x divide-slate-200 rounded-2xl bg-white py-6 shadow-xl shadow-blue-900/10 md:py-8" data-aos="fade-up" data-aos-delay="400">
                @foreach ([['Siswa', $totalSiswa], ['Guru', $totalGuru], ['Ekstrakurikuler', $totalEskul]] as [$label, $total])
                    <div class="px-2 text-center">
                        <p class="text-3xl font-extrabold text-blue-900 md:text-5xl">{{ $total }}</p>
                        <p class="mt-1 text-xs font-medium text-slate-500 md:text-sm">{{ $label }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== SAMBUTAN KEPSEK ==================== --}}
        @if($profil)
            <section id="tentang" class="scroll-mt-20 py-20 md:py-28">
                <div class="mx-auto grid max-w-6xl items-center gap-12 px-4 md:grid-cols-3 md:gap-16">
                    <div class="mx-auto w-full max-w-xs">
                        <div class="aspect-[3/4] overflow-hidden rounded-b-2xl rounded-t-full border-b-8 border-amber-400 bg-sky-100">
                            @if($profil->foto && Storage::disk('public')->exists($profil->foto))
                                <img src="{{ asset('storage/' . $profil->foto) }}" alt="{{ $profil->kepala_sekolah }}" class="h-full w-full object-cover">
                            @else
                                <div class="flex h-full items-center justify-center text-7xl font-extrabold text-sky-300">{{ strtoupper(substr($profil->kepala_sekolah ?? '?', 0, 1)) }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <h2 class="text-3xl font-extrabold tracking-tight text-blue-950 md:text-4xl">Sambutan Kepala Sekolah</h2>
                        <p class="mt-2 font-semibold text-sky-700">{{ $profil->kepala_sekolah }}</p>
                        <div class="mt-6 border-l-4 border-amber-400 bg-sky-50 py-5 pl-6 pr-5 leading-relaxed text-slate-700">
                            {!! nl2br(e($profil->visi_misi)) !!}
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- ==================== BERITA TERBARU ==================== --}}
        @if($beritaTerbaru->isNotEmpty())
            <section class="bg-sky-50 py-20 md:py-28">
                <div class="mx-auto max-w-6xl px-4">
                    <div class="mb-10 flex items-end justify-between gap-4">
                        <h2 class="text-3xl font-extrabold tracking-tight text-blue-950 md:text-4xl">Berita Terbaru</h2>
                        <a href="{{ route('berita.index') }}" class="text-sm font-semibold text-blue-900 underline decoration-amber-400 decoration-2 underline-offset-4 hover:text-sky-700">Lihat semua</a>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($beritaTerbaru as $item)
                            <a href="#" class="group overflow-hidden rounded-xl bg-white shadow-sm" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                                <div class="relative aspect-video overflow-hidden bg-sky-100">
                                    @if($item->gambar && Storage::disk('public')->exists($item->gambar))
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                             class="h-full w-full object-cover motion-safe:transition motion-safe:duration-500 motion-safe:group-hover:scale-105">
                                    @endif
                                    <span class="absolute left-3 top-3 rounded-md bg-amber-400 px-2.5 py-1 text-xs font-bold text-blue-950">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <div class="p-5">
                                    <h3 class="line-clamp-2 font-bold text-blue-950 group-hover:text-sky-700">{{ $item->judul }}</h3>
                                    <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-slate-600">{{ Str::limit(strip_tags($item->isi), 100) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- ==================== EKSTRAKURIKULER ==================== --}}
        @if($ekstrakurikuler->isNotEmpty())
            <section class="py-20 md:py-28">
                <div class="mx-auto max-w-6xl px-4">
                    <div class="mb-10 flex items-end justify-between gap-4">
                        <h2 class="text-3xl font-extrabold tracking-tight text-blue-950 md:text-4xl">Ekstrakurikuler</h2>
                        <a href="{{ route('ekstrakurikuler.index') }}" class="text-sm font-semibold text-blue-900 underline decoration-amber-400 decoration-2 underline-offset-4 hover:text-sky-700">Lihat semua</a>
                    </div>

                    <div class="grid gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach($ekstrakurikuler as $item)
                            <div class="border-t-2 border-sky-500 pt-6">
                                <div class="flex h-16 w-[74px] items-center justify-center bg-blue-900 text-lg font-extrabold text-amber-400 [clip-path:polygon(25%_0,75%_0,100%_50%,75%_100%,25%_100%,0_50%)]">
                                    {{ strtoupper(substr($item->nama_eskul, 0, 2)) }}
                                </div>
                                <h3 class="mt-4 font-bold text-blue-950">{{ $item->nama_eskul }}</h3>
                                <p class="mt-2 text-sm text-slate-600">Pembina: {{ $item->pembina }}</p>
                                <p class="text-sm text-slate-600">Jadwal: {{ $item->jadwal_latihan }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- ==================== GALERI ==================== --}}
        @if($galeris->isNotEmpty())
            <section class="bg-sky-50 py-20 md:py-28">
                <div class="mx-auto max-w-6xl px-4">
                    <div class="mb-10 flex items-end justify-between gap-4">
                        <h2 class="text-3xl font-extrabold tracking-tight text-blue-950 md:text-4xl">Galeri</h2>
                        <a href="{{ route('galeri.index') }}" class="text-sm font-semibold text-blue-900 underline decoration-amber-400 decoration-2 underline-offset-4 hover:text-sky-700">Lihat semua</a>
                    </div>

                    <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-3">
                        @foreach($galeris as $item)
                            @php $isVideo = in_array(strtolower(pathinfo($item->file, PATHINFO_EXTENSION)), ['mp4', 'webm', 'mov']); @endphp
                            <div class="relative aspect-square overflow-hidden rounded-lg bg-sky-100 {{ $loop->first ? 'col-span-2 row-span-2' : '' }}"
                                 data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                                @if($item->file && Storage::disk('public')->exists($item->file))
                                    @if($isVideo)
                                        <video src="{{ asset('storage/' . $item->file) }}" class="h-full w-full object-cover" muted preload="metadata"></video>
                                        <div class="absolute inset-0 flex items-center justify-center bg-blue-950/40">
                                            <span class="flex h-12 w-12 items-center justify-center rounded-full bg-amber-400 pl-1 text-blue-950">&#9654;</span>
                                        </div>
                                    @else
                                        <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->judul }}" class="h-full w-full object-cover">
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- ==================== GURU ==================== --}}
        @if($gurus->isNotEmpty())
            <section class="py-20 md:py-28">
                <div class="mx-auto max-w-6xl px-4">
                    <h2 class="mb-10 text-3xl font-extrabold tracking-tight text-blue-950 md:text-4xl">Guru &amp; Staf</h2>

                    <div class="grid grid-cols-2 gap-x-5 gap-y-10 sm:grid-cols-3 lg:grid-cols-5">
                        @foreach($gurus as $item)
                            <div data-aos="fade-up" data-aos-delay="{{ ($loop->index % 5) * 100 }}">
                                <div class="aspect-[3/4] overflow-hidden rounded-b-xl rounded-t-full border-b-4 border-sky-500 bg-sky-100">
                                    @if($item->foto && Storage::disk('public')->exists($item->foto))
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_guru }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full items-center justify-center text-5xl font-extrabold text-sky-300">{{ strtoupper(substr($item->nama_guru, 0, 1)) }}</div>
                                    @endif
                                </div>
                                <h3 class="mt-4 text-center text-sm font-bold text-blue-950">{{ $item->nama_guru }}</h3>
                                <p class="text-center text-xs text-slate-500">{{ $item->mapel }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- ==================== CTA ==================== --}}
        <section class="relative overflow-hidden bg-gradient-to-r from-blue-950 via-blue-900 to-sky-700 py-20 text-center text-white">
            <div class="absolute -right-16 -top-20 h-72 w-72 bg-amber-400/10 [clip-path:polygon(25%_0,75%_0,100%_50%,75%_100%,25%_100%,0_50%)]"></div>
            <div class="relative mx-auto max-w-3xl px-4" data-aos="zoom-in">
                <h2 class="text-3xl font-extrabold tracking-tight md:text-4xl">Tertarik Bergabung?</h2>
                <p class="mx-auto mt-4 max-w-xl text-sky-100">Daftarkan dirimu dan jadi bagian dari keluarga besar {{ $profil?->nama_sekolah ?? 'SMK YPC' }}.</p>
                <a href="{{ route('login') }}" class="mt-8 inline-block rounded-full bg-amber-400 px-8 py-3.5 text-sm font-bold text-blue-950 transition hover:bg-amber-300">Daftar Sekarang</a>
            </div>
        </section>

    </main>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="bg-blue-950 text-sky-100">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-14 text-center sm:text-left md:grid-cols-3">
            <div>
                <img src="{{ asset('assets/smkypc.jpeg') }}" alt="" class="mx-auto h-14 w-auto rounded-lg bg-white p-1 sm:mx-0">
                <p class="mt-4 font-bold text-white">{{ $profil?->nama_sekolah ?? 'SMK YPC Tasikmalaya' }}</p>
                <p class="mt-1 text-sm text-sky-200">Mencetak generasi siap kerja dan berakhlak mulia.</p>
            </div>

            <div>
                <p class="font-bold text-amber-400">Kontak</p>
                @if($profil?->alamat)
                    <p class="mt-3 text-sm">{{ $profil->alamat }}</p>
                @endif
                @if($profil?->kontak)
                    <p class="mt-1 text-sm">Telp: {{ $profil->kontak }}</p>
                @endif
            </div>

            <div>
                <p class="font-bold text-amber-400">Ikuti Kami</p>
                <div class="mt-3 flex justify-center gap-3 sm:justify-start">
                    <a href="#" class="rounded-full border border-sky-400/50 px-4 py-1.5 text-sm transition hover:bg-amber-400 hover:text-blue-950">Facebook</a>
                    <a href="#" class="rounded-full border border-sky-400/50 px-4 py-1.5 text-sm transition hover:bg-amber-400 hover:text-blue-950">Instagram</a>
                </div>
            </div>
        </div>

        <div class="border-t border-white/10 py-5 text-center text-xs text-sky-300">
            &copy; {{ date('Y') }} {{ $profil?->nama_sekolah ?? 'SMK YPC' }}. All rights reserved.
        </div>
    </footer>

</body>
</html>
