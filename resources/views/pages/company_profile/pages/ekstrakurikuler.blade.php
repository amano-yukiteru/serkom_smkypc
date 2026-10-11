@extends('pages.company_profile.layouts.index')

@section('title', 'Ekstrakurikuler')

@section('content')
    @if($ekstrakurikuler->isEmpty())
        <div class="rounded-xl border border-slate-100 bg-white p-12 text-center shadow-md">
            <p class="text-slate-500">Belum ada ekstrakurikuler.</p>
        </div>
    @else
        <div class="mx-auto grid max-w-6xl gap-6 px-4 pt-28 pb-10 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($ekstrakurikuler as $item)
<<<<<<< HEAD
                <a href="{{ route('publik.ekstrakurikuler.detail', ['encryptedId' => Crypt::encrypt($item->id)]) }}"
                    class="group overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md transition hover:shadow-lg"
                    data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">

                    <div class="relative aspect-video overflow-hidden bg-sky-100">
                        @if($item->foto && Storage::disk('public')->exists($item->foto))
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_eskul }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            <div class="flex h-full items-center justify-center text-4xl font-bold text-sky-300">
                                {{-- {{ strtoupper(substr($item->nama_eskul, 0, 2)) }} --}}
                            </div>
                        @endif

                        {{-- <span class="absolute left-3 top-3 rounded-md bg-blue-900/90 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                            {{ strtoupper(substr($item->nama_eskul, 0, 2)) }}
                        </span> --}}
                    </div>

                    <div class="p-6">
                        <h3 class="line-clamp-2 text-lg font-bold text-blue-950 group-hover:text-sky-700">{{ $item->nama_eskul }}</h3>
=======
                <div class="overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md transition hover:shadow-lg"
                    data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">

                    {{-- GAMBAR --}}
                    <div class="relative aspect-video overflow-hidden bg-sky-100">
                        @if($item->foto && Storage::disk('public')->exists($item->foto))
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_eskul }}"
                                class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full items-center justify-center text-4xl font-bold text-sky-300">
                                {{ strtoupper(substr($item->nama_eskul, 0, 2)) }}
                            </div>
                        @endif

                        {{-- BADGE 2 HURUF DI KIRI ATAS --}}
                        <span class="absolute left-3 top-3 rounded-md bg-blue-900/90 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                            {{ strtoupper(substr($item->nama_eskul, 0, 2)) }}
                        </span>
                    </div>

                    {{-- KONTEN --}}
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-blue-950">{{ $item->nama_eskul }}</h3>
>>>>>>> 0d8e2e83532fdae944a4bb9c32d1f62477840235
                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            <span class="font-semibold text-slate-700">Pembina:</span> {{ $item->pembina }}
                        </p>
                        <p class="mt-1 text-sm leading-relaxed text-slate-600">
                            <span class="font-semibold text-slate-700">Jadwal:</span> {{ $item->jadwal_latihan }}
                        </p>
<<<<<<< HEAD
                        {{-- <p class="mt-4 text-xs font-semibold text-blue-900 group-hover:text-sky-600">
                            Lihat detail →
                        </p> --}}
                    </div>
                </a>
            @endforeach
        </div>

        {{-- <div class="mt-10">{{ $ekstrakurikuler->links() }}</div> --}}
=======
                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            {{ $item->deskripsi }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10">{{ $ekstrakurikuler->links() }}</div>
>>>>>>> 0d8e2e83532fdae944a4bb9c32d1f62477840235
    @endif
@endsection