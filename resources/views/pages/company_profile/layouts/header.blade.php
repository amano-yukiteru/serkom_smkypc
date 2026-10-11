<header class="fixed inset-x-0 top-0 z-50 bg-white shadow-md" data-aos="fade-down" data-aos-duration="800">
    <div class="mx-auto flex h-[72px] max-w-6xl items-center justify-between px-4">

        <a href="{{ route('home') }}" class="flex items-center gap-3">
            @if($profil?->logo && Storage::disk('public')->exists($profil->logo))
                <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo sekolah" class="h-12 w-auto">
            @else
                <img src="{{ asset('assets/smkypc.jpeg') }}" alt="Logo sekolah" class="h-12 w-auto rounded">
            @endif
            <span class="leading-tight">
                <strong class="block text-xl font-extrabold text-blue-900">{{ $profil?->nama_sekolah ?? 'SMK YPC' }}</strong>
                <span class="block text-[11px] font-semibold tracking-widest text-sky-600">TASIKMALAYA</span>
            </span>
        </a>

        <nav class="hidden items-center gap-1 md:flex">
            <a href="{{ route('home') }}"
                class="rounded-full px-2.5 py-2 text-sm font-semibold transition hover:text-blue-900
                    {{ request()->routeIs('home') ? 'text-blue-900' : 'text-slate-600' }}">
                Beranda
            </a>
            <a href="{{ route('publik.jurusan') }}"
                class="rounded-full px-2.5 py-2 text-sm font-semibold transition hover:text-blue-900
                    {{ request()->routeIs('publik.jurusan*') ? 'text-blue-900' : 'text-slate-600' }}">
                Jurusan
            </a>
            <a href="{{ route('publik.ekstrakurikuler') }}"
                class="rounded-full px-2.5 py-2 text-sm font-semibold transition hover:text-blue-900
                    {{ request()->routeIs('publik.ekstrakurikuler*') ? 'text-blue-900' : 'text-slate-600' }}">
                Ekstrakurikuler
            </a>
            <a href="{{ route('publik.berita') }}"
                class="rounded-full px-2.5 py-2 text-sm font-semibold transition hover:text-blue-900
                    {{ request()->routeIs('publik.berita*') ? 'text-blue-900' : 'text-slate-600' }}">
                Berita
            </a>
            <a href="{{ route('publik.galeri') }}"
                class="rounded-full px-2.5 py-2 text-sm font-semibold transition hover:text-blue-900
                    {{ request()->routeIs('publik.galeri') ? 'text-blue-900' : 'text-slate-600' }}">
                Galeri
            </a>
            <a href="{{ route('publik.guru') }}"
                class="rounded-full px-2.5 py-2 text-sm font-semibold transition hover:text-blue-900
                    {{ request()->routeIs('publik.guru') ? 'text-blue-900' : 'text-slate-600' }}">
                Guru
            </a>
            <a href="{{ route('publik.kerjasama') }}"
                class="rounded-full px-2.5 py-2 text-sm font-semibold transition hover:text-blue-900
                    {{ request()->routeIs('publik.kerjasama') ? 'text-blue-900' : 'text-slate-600' }}">
                Kerjasama
            </a>
        </nav>

        <button id="hamburger" type="button" aria-label="Buka menu"
            class="flex h-10 w-10 flex-col items-center justify-center gap-1 md:hidden">
            <span class="block h-0.5 w-6 bg-blue-900"></span>
            <span class="block h-0.5 w-6 bg-blue-900"></span>
            <span class="block h-0.5 w-6 bg-blue-900"></span>
        </button>
    </div>

    <div id="mobileMenu" class="hidden border-t border-slate-200 bg-white p-3 md:hidden">
        <a href="{{ route('home') }}"
            class="block rounded-xl px-4 py-3 text-sm font-semibold transition hover:bg-sky-50 hover:text-blue-900
                {{ request()->routeIs('home') ? 'text-blue-900' : 'text-slate-600' }}">
            Beranda
        </a>
        <a href="{{ route('publik.jurusan') }}"
            class="block rounded-xl px-4 py-3 text-sm font-semibold transition hover:bg-sky-50 hover:text-blue-900
                {{ request()->routeIs('publik.jurusan*') ? 'text-blue-900' : 'text-slate-600' }}">
            Jurusan
        </a>
        <a href="{{ route('publik.ekstrakurikuler') }}"
            class="block rounded-xl px-4 py-3 text-sm font-semibold transition hover:bg-sky-50 hover:text-blue-900
                {{ request()->routeIs('publik.ekstrakurikuler*') ? 'text-blue-900' : 'text-slate-600' }}">
            Ekstrakurikuler
        </a>
        <a href="{{ route('publik.berita') }}"
            class="block rounded-xl px-4 py-3 text-sm font-semibold transition hover:bg-sky-50 hover:text-blue-900
                {{ request()->routeIs('publik.berita*') ? 'text-blue-900' : 'text-slate-600' }}">
            Berita
        </a>
        <a href="{{ route('publik.galeri') }}"
            class="block rounded-xl px-4 py-3 text-sm font-semibold transition hover:bg-sky-50 hover:text-blue-900
                {{ request()->routeIs('publik.galeri') ? 'text-blue-900' : 'text-slate-600' }}">
            Galeri
        </a>
        <a href="{{ route('publik.guru') }}"
            class="block rounded-xl px-4 py-3 text-sm font-semibold transition hover:bg-sky-50 hover:text-blue-900
                {{ request()->routeIs('publik.guru') ? 'text-blue-900' : 'text-slate-600' }}">
            Guru
        </a>
        <a href="{{ route('publik.kerjasama') }}"
            class="block rounded-xl px-4 py-3 text-sm font-semibold transition hover:bg-sky-50 hover:text-blue-900
                {{ request()->routeIs('publik.kerjasama') ? 'text-blue-900' : 'text-slate-600' }}">
            Kerjasama
        </a>
    </div>
</header>

<script>
    document.getElementById('hamburger').addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });
</script>