<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil?->nama_sekolah ?? 'SMK YPC' }} Tasikmalaya</title>
   <link rel="icon"
    href="{{ $profil?->logo
        ? asset('storage/' . $profil->logo)
        : asset('assets/smkypc.jpeg') }}"
    type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/aos/aos.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-white text-slate-800 antialiased">

    @include('pages.company_profile.layouts.header')
    <x-ui.breadcrumb/>

    @yield('content')

{{-- footer --}}
    <footer class="bg-blue-950 text-sky-100">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-12 text-center md:grid-cols-3 md:text-left">

            <div data-aos="fade-up">
                <img src="{{ asset('assets/smkypc.jpeg') }}" alt="Logo sekolah"
                    class="mx-auto h-14 w-auto rounded-lg bg-white p-1 md:mx-0">
                <p class="mt-4 font-bold text-white">{{ $profil?->nama_sekolah ?? 'SMK YPC Tasikmalaya' }}</p>
            </div>

            <div data-aos="fade-up" data-aos-delay="100">
                <p class="font-semibold text-white">Kontak</p>
                @if($profil?->alamat)
                    <p class="mt-3 text-sm">{{ $profil->alamat }}</p>
                @endif
                @if($profil?->kontak)
                    <p class="mt-1 text-sm">Telp: {{ $profil->kontak }}</p>
                @endif
            </div>

            <div data-aos="fade-up" data-aos-delay="200">
                <p class="font-semibold text-white">Ikuti Kami</p>
                <div class="mt-3 flex justify-center gap-3 md:justify-start">
                    <a href="https://web.facebook.com/smkypc?locale=id_ID" target="_blank" rel="noopener noreferrer"
                        class="rounded-full border border-sky-400/50 px-4 py-1.5 text-sm transition hover:bg-white hover:text-blue-950">Facebook</a>
                    <a href="https://www.instagram.com/smksypctasikmalaya/" target="_blank" rel="noopener noreferrer"
                        class="rounded-full border border-sky-400/50 px-4 py-1.5 text-sm transition hover:bg-white hover:text-blue-950">Instagram</a>
                </div>
            </div>
        </div>

        <div class="border-t border-white/10 py-5 text-center text-xs text-sky-300">
            &copy; {{ date('Y') }} {{ $profil?->nama_sekolah ?? 'SMK YPC' }}. All rights reserved.
        </div>
    </footer>

    {{-- ==================== AOS SCRIPT ==================== --}}
    <script src="{{ asset('assets/aos/aos.js') }}"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
        });
    </script>

</body>

</html>