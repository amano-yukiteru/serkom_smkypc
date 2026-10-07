@extends('pages.company_profile.layouts.index')
@section('header')
     <header class="w-full h-auto bg-white shadow-md fixed" data-aos="fade-down" data-aos-duration="1500">
        <div class="flex justify-between h-full px-10">
            <ul class="flex w-auto h-full ">
                <li class="flex justify-center">
                    <img src="{{ asset('assets/smkypc.jpeg') }}" alt="No img" class="w-18 h-auto py-3 px-1">
                <div class="flex flex-col justify-center ml-2">
                    <strong>
                        <h1 class="text-[1.6rem] text-gray-700">
                            SMK YPC 
                        </h1>
                        <span class="text-3 font-semibold text-gray-700"> TASIKMALAYA </span>
                    </strong>
                </div>
                </li>
            </ul>
            <ul class="flex w-auto h-full align-items-center my-auto text-gray-600" >
                <li class="my-auto mx-2.5 hover:text-blue-500 transition duration-200 font-semibold text-md"><a href="#">Profile</a></li>
                <li class="my-auto mx-2.5 hover:text-blue-500 transition duration-200 font-semibold text-md"><a href="#">Berita</a></li>
                <li class="my-auto mx-2.5 hover:text-blue-500 transition duration-200 font-semibold text-md"><a href="#">Galeri</a></li>
                <li class="my-auto mx-2.5 hover:text-blue-500 transition duration-200 font-semibold text-md"><a href="#">Guru</a></li>
                <li class="my-auto mx-2.5 hover:text-blue-500 transition duration-200 font-semibold text-md"><a href="#"> Ekstrakurikuler</a></li>
            </ul>
        </div>

    </header>
@endsection