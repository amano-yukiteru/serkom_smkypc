@php
    $route = [
        'Profile' => 'profil',
        'Berita' => 'berita',
        'Galeri' => 'galeri',
        'Guru' => 'guru',
        'Ekstrakurikuler' => 'eskul',
    ];
@endphp

<body class="bg-[#eaeaea]">
    <header class="w-full h-auto bg-white shadow-md fixed z-20" data-aos="fade-down" data-aos-duration="1500">
        <div class="flex justify-between items-center h-full px-4 md:px-15">
            <!-- Logo -->
            <ul class="flex w-auto h-full">
                <li class="flex justify-center items-center">
                    <img src="{{ asset('assets/smkypc.jpeg') }}" alt="No img" class="w-14 md:w-18 h-auto py-3 px-1">
                    <div class="flex flex-col justify-center ml-2">
                        <strong>
                            <h1 class="text-xl text-[1.6rem] text-gray-700">SMK YPC</h1>
                            <span class="text-xs md:text-sm font-semibold text-gray-700">TASIKMALAYA</span>
                        </strong>
                    </div>
                </li>
            </ul>

            <ul class="hidden md:flex w-auto h-full items-center my-auto text-gray-600">
                @foreach ($route as $label => $link)
                    <li class="my-auto mx-2.5 hover:text-blue-500 transition duration-200 font-semibold text-md">
                        <a href="{{ $link }}">{{ $label }}</a>
                    </li>
                @endforeach
            </ul>

            <button id="hamburger" class="md:hidden flex flex-col justify-center items-center gap-1 w-10 h-10 focus:outline-none">
                <span class="block w-6 h-0.5 bg-gray-700"></span>
                <span class="block w-6 h-0.5 bg-gray-700"></span>
                <span class="block w-6 h-0.5 bg-gray-700"></span>
            </button>
        </div>

        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200">
            <ul class="flex flex-col">
                @foreach ($route as $label => $link)
                    <li>
                        <a href="{{ $link }}" class="block px-6 py-3 text-gray-600 font-semibold hover:text-blue-500 hover:bg-gray-50 transition">
                            {{ $label }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </header>

    <script>
        document.getElementById('hamburger').addEventListener('click', function () {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>
</body>