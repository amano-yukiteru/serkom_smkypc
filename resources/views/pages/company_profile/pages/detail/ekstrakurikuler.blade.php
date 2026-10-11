@extends('pages.company_profile.layouts.index')

@section('title', $ekstrakurikuler->nama_eskul)

@section('content')
    <article class="mx-auto max-w-4xl px-4 pt-28 pb-10">

        {{-- HEADER: FOTO + INFO --}}
        <div class="grid gap-8 md:grid-cols-2 md:items-center" data-aos="fade-up">

            {{-- FOTO --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md">
                @if($ekstrakurikuler->foto && Storage::disk('public')->exists($ekstrakurikuler->foto))
                    <img src="{{ asset('storage/' . $ekstrakurikuler->foto) }}" alt="{{ $ekstrakurikuler->nama_eskul }}"
                        class="h-full w-full object-cover">
                @else
                    <div class="flex h-full items-center justify-center text-6xl font-bold text-sky-300">
                        {{ strtoupper(substr($ekstrakurikuler->nama_eskul, 0, 2)) }}
                    </div>
                @endif

                {{-- <span class="absolute left-3 top-3 rounded-md bg-blue-900/90 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                    {{ strtoupper(substr($ekstrakurikuler->nama_eskul, 0, 2)) }}
                </span> --}}
            </div>

            {{-- INFO --}}
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-blue-950 md:text-4xl">
                    {{ $ekstrakurikuler->nama_eskul }}
                </h1>
                <p class="mt-3 text-sm text-slate-500">
                    Kegiatan ekstrakurikuler {{ $profil?->nama_sekolah ?? 'SMK YPC Tasikmalaya' }}
                </p>

                <div class="mt-6 space-y-3 border-t border-slate-200 pt-5">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Pembina</p>
                        <p class="mt-1 text-base font-bold text-blue-900">{{ $ekstrakurikuler->pembina }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Jadwal Latihan</p>
                        <p class="mt-1 text-base font-bold text-blue-900">{{ $ekstrakurikuler->jadwal_latihan }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- DESKRIPSI --}}
        @if($ekstrakurikuler->deskripsi)
            <div class="mt-10" data-aos="fade-up" data-aos-delay="100">
                <h2 class="text-2xl font-bold text-blue-950">Tentang Ekstrakurikuler</h2>
                <div class="mt-4 leading-relaxed text-slate-700">
                    {!! nl2br(e($ekstrakurikuler->deskripsi)) !!}
                </div>
            </div>
        @endif

        {{-- KEMBALI --}}
        <div class="mt-10 border-t border-slate-200 pt-5" data-aos="fade-up">
            <a href="{{ route('publik.ekstrakurikuler') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-blue-900 hover:text-white transition duration-150 hover:bg-blue-900 px-5 py-3 rounded-full border-1 border-gray-500">
                Kembali ke Ekstrakurikuler
            </a>
        </div>
    </article>
@endsection