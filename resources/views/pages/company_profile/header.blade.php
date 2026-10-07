@php
    $route = [
        'Profile' => 'profil',
        'Berita' => 'berita',
        'Galeri' => 'galeri',
        'Guru' => 'guru',
        'Ekstrakurikuler' => 'eskul',
    ];
@endphp

<header class="fixed inset-x-0 top-0 z-50 bg-white shadow-md" data-aos="fade-down" data-aos-duration="800">
    <div class="mx-auto flex h-[72px] max-w-6xl items-center justify-between px-4">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <img src="{{ asset('assets/smkypc.jpeg') }}" alt="Logo SMK YPC" class="h-12 w-auto">
            <span class="leading-tight">
                <strong class="block text-xl font-extrabold text-blue-900">SMK YPC</strong>
                <span class="block text-[11px] font-semibold tracking-widest text-sky-600">TASIKMALAYA</span>
            </span>
        </a>

        <nav class="hidden items-center gap-1 md:flex">
            @foreach ($route as $label => $link)
                <a href="{{ url($link) }}"
                   class="rounded-full px-4 py-2 text-sm font-semibold transition hover:bg-sky-50 hover:text-blue-900 {{ request()->is($link . '*') ? 'bg-sky-50 text-blue-900' : 'text-slate-600' }}">
                    {{ $label }}
                </a>
            @endforeach
            <a href="{{ route('login') }}" class="ml-3 rounded-full bg-blue-900 px-5 py-2 text-sm font-semibold text-white transition hover:bg-sky-600">Daftar</a>
        </nav>

        <button id="hamburger" type="button" aria-label="Buka menu" class="flex h-10 w-10 flex-col items-center justify-center gap-1 md:hidden">
            <span class="block h-0.5 w-6 bg-blue-900"></span>
            <span class="block h-0.5 w-6 bg-blue-900"></span>
            <span class="block h-0.5 w-6 bg-blue-900"></span>
        </button>
    </div>

    <div class="h-1 bg-gradient-to-r from-blue-900 via-sky-500 to-amber-400"></div>

    <div id="mobileMenu" class="hidden border-t border-slate-200 bg-white p-3 md:hidden">
        @foreach ($route as $label => $link)
            <a href="{{ url($link) }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-sky-50 hover:text-blue-900">{{ $label }}</a>
        @endforeach
        <a href="{{ route('login') }}" class="mt-2 block rounded-full bg-blue-900 px-4 py-3 text-center text-sm font-semibold text-white">Daftar Sekarang</a>
    </div>
</header>

<script>
    document.getElementById('hamburger').addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });
</script>
