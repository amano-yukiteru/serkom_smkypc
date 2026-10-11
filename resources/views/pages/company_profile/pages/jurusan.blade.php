@extends('pages.company_profile.layouts.index')

@section('title', 'Jurusan')

@section('content')
    @if($jurusans->isEmpty())
        <div class="rounded-xl border border-slate-100 bg-white p-12 text-center shadow-md">
            <p class="text-slate-500">Belum ada jurusan.</p>
        </div>
    @else
        <div class="mx-auto grid max-w-6xl gap-6 px-4 pt-28 pb-10 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($jurusans as $item)
                <div class="overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md transition hover:shadow-lg"
                    data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="relative aspect-video overflow-hidden bg-sky-100">
                        @if($item->logo && Storage::disk('public')->exists($item->logo))
                            <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->nama }}"
                                class="h-full w-full object-contain p-4">
                        @else
                            <div class="flex h-full items-center justify-center text-4xl font-bold text-sky-300">
                                {{ strtoupper($item->singkatan) }}
                            </div>
                        @endif

                        {{-- BADGE SINGKATAN DI KIRI ATAS --}}
                        <span class="absolute left-3 top-3 rounded-md bg-blue-900/90 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                            {{ $item->singkatan }}
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-blue-950">{{ $item->nama }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $item->deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10">{{ $jurusans->links() }}</div>
    @endif
@endsection