<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMK YPC</title>

    <link rel="stylesheet" href="{{ asset('assets/aos/aos.css') }}">
    <link rel="icon" href="{{ asset('assets/smkypc.jpeg') }} " type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#eaeaea]">
    @yield('header')
    <script src="{{ asset('assets/aos/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>