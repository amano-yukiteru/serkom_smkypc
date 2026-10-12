@extends('pages.company_profile.layouts.index')

{{-- @section('title', $berita->judul) --}}

@section('content')
    <article class="mx-auto max-w-3xl px-4 pt-28 pb-10">

        {{-- <nav class="mb-6 flex items-center gap-2 text-sm text-slate-500" data-aos="fade-up">
            <a href="{{ route('home') }}" class="hover:text-blue-900">Beranda</a>
            <span>/</span>
            <a href="{{ route('publik.berita') }}" class="hover:text-blue-900">Berita</a>
            <span>/</span>
            <span class="text-slate-700">Detail</span>
        </nav> --}}

        {{-- <h1 class="text-3xl font-bold leading-tight tracking-tight text-blue-950 md:text-4xl" data-aos="fade-up">
            {{ $berita->judul }}
        </h1> --}}

        <div class="mt-5 flex flex-wrap items-center gap-x-6 gap-y-2 border-b border-slate-200 pb-5 text-sm text-slate-500" data-aos="fade-up" data-aos-delay="100">
            <span class="inline-flex items-center gap-2">
                <strong>Tanggal : </strong>
                <span>{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</span>
            </span>
            <span class="inline-flex items-center gap-2">
                <strong>Pembuat : </strong>
                <span>{{ $berita->user?->name ?? 'Admin' }}</span>
            </span>
        </div>

        @if($berita->gambar && Storage::disk('public')->exists($berita->gambar))
            <div class="mt-8 overflow-hidden rounded-xl shadow-md" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                    class="w-full object-cover">
            </div>
        @endif

        <div class="mt-8 leading-loose text-slate-700" data-aos="fade-up" data-aos-delay="300">
            {{ $berita->isi) }}
        </div>

        <div class="mt-10 border-t border-slate-200 pt-5" data-aos="fade-up">
            <a href="{{ route('publik.berita') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-blue-900 hover:text-white transition duration-150 hover:bg-blue-900 px-5 py-3 rounded-full border-1 border-gray-500">
                
                Kembali ke Berita
            </a>
        </div>

    </article>
@endsection