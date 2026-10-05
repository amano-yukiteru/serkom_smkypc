<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMK YPC</title>

    <link rel="stylesheet" href="{{ asset('assets/aos/aos.css') }}">
    <link rel="icon" href="{{ asset('assets/smkypc.jpeg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#eaeaea]">

    {{-- Header --}}
    @include('pages.company_profile.layouts.header')

    {{-- Konten utama (padding atas sebagai spacer header fixed) --}}
    <main class="pt-[80px] max-md:pt-[66px] max-w-[1920px]">

        {{-- Section 1: Hero --}}
        <section class="mx-auto">
            <div class="w-full h-[512px] max-md:h-[400px] max-sm:h-[340px] bg-gray-400 
                        flex justify-center items-center flex-col gap-6 md:gap-10 px-4">
                <div class="max-w-xl text-center">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-semibold">
                        Selamat datang di SMK YPC Tasikmalaya
                    </h1>
                </div>
                <a href="#"
                   class="bg-blue-600 px-6 md:px-8 py-2.5 md:py-3 rounded-3xl text-white 
                          hover:bg-blue-700 transition duration-200">
                    Contact Me
                </a>
            </div>
        </section>

        {{-- Section 2: Statistik / Info --}}
        <section class="mx-auto">
            <div class="w-full h-[512px] max-md:h-[400px] max-sm:h-[340px] bg-blue-400 
                        flex justify-center items-center flex-col gap-6 md:gap-10 px-4">
                
            </div>
        </section>

    </main>

    <script src="{{ asset('assets/aos/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>