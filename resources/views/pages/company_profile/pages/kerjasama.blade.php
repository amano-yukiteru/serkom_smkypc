@extends('pages.company_profile.layouts.index')

@section('title', 'Kerjasama')

@section('content')
    @if($kerjasamas->isEmpty())
        <div class="rounded-xl border border-slate-100 bg-white p-12 text-center shadow-md">
            <p class="text-slate-500">Belum ada kerjasama.</p>
        </div>
    @else
        <div class="mx-auto grid max-w-6xl gap-6 px-4 pt-28 pb-10 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($kerjasamas as $item)
                <div class="group overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md transition hover:shadow-lg"
                    data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">

<<<<<<< HEAD
=======
                    {{-- GAMBAR --}}
>>>>>>> 0d8e2e83532fdae944a4bb9c32d1f62477840235
                    <div class="relative aspect-video overflow-hidden bg-sky-100">
                        @if($item->foto && Storage::disk('public')->exists($item->foto))
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_perusahaan }}"
                                class="h-full w-full object-contain p-4 transition duration-500 group-hover:scale-105">
                        @else
                            <div class="flex h-full items-center justify-center text-4xl font-bold text-sky-300">
                                {{ strtoupper(substr($item->nama_perusahaan, 0, 2)) }}
                            </div>
                        @endif

<<<<<<< HEAD
=======
                        {{-- BADGE PARTNER DI KIRI ATAS --}}
>>>>>>> 0d8e2e83532fdae944a4bb9c32d1f62477840235
                        {{-- <span class="absolute left-3 top-3 rounded-md bg-blue-900/90 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                            Partner
                        </span> --}}
                    </div>

<<<<<<< HEAD
=======
                    {{-- KONTEN --}}
>>>>>>> 0d8e2e83532fdae944a4bb9c32d1f62477840235
                    <div class="p-6">
                        <h3 class="line-clamp-2 text-lg font-bold text-blue-950 group-hover:text-sky-700">
                            {{ $item->nama_perusahaan }}
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10">{{ $kerjasamas->links() }}</div>
    @endif
@endsection