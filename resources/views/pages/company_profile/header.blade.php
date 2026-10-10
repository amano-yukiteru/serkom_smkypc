@php
    $routes = [
        // 'Profile'         => 'profil_sekolah.index',
        // 'Berita'          => 'berita.index',      // ← sesuaikan
        // 'Galeri'          => 'galeri.index',      // ← sesuaikan
        // 'Guru'            => 'guru.index',        // ← sesuaikan
        // 'Ekstrakurikuler' => 'eskul.index',       // ← sesuaikan
    ];
@endphp

<header class="fixed inset-x-0 top-0 z-50 bg-white shadow-md" data-aos="fade-down" data-aos-duration="800">
    <div class="mx-auto flex h-[72px] max-w-6xl items-center justify-between px-4">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/smkypc.jpeg') }}" alt="Logo SMK YPC" class="h-12 w-auto">
            <span class="leading-tight">
                <strong class="block text-xl font-extrabold text-blue-900">SMK YPC</strong>
                <span class="block text-[11px] font-semibold tracking-widest text-sky-600">TASIKMALAYA</span>
            </span>
        </div>

        <nav class="hidden items-center gap-1 md:flex">
            @foreach ($routes as $label => $route)
                <a href="{{ route($route) }}"
                   class="rounded-full px-4 py-2 text-sm font-semibold transition hover:text-blue-900 ">
                    {{ $label }}
                </a>
            @endforeach
        </nav>

        <button id="hamburger" type="button" aria-label="Buka menu" class="flex h-10 w-10 flex-col items-center justify-center gap-1 md:hidden">
            <span class="block h-0.5 w-6 bg-blue-900"></span>
            <span class="block h-0.5 w-6 bg-blue-900"></span>
            <span class="block h-0.5 w-6 bg-blue-900"></span>
        </button>
    </div>

    <div id="mobileMenu" class="hidden border-t border-slate-200 bg-white p-3 md:hidden">
        @foreach ($routes as $label => $route)
            <a href="{{ route($route) }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-sky-50 hover:text-blue-900">{{ $label }}</a>
        @endforeach
    </div>
</header>

<script>
    document.getElementById('hamburger').addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });
</script>