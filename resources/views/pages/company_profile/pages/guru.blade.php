@extends('pages.company_profile.layouts.index')

@section('title', 'Guru & Staf')

@section('content')
    @if($gurus->isEmpty())
        <div class="rounded-xl border border-slate-100 bg-white p-12 text-center shadow-md">
            <p class="text-slate-500">Belum ada data guru.</p>
        </div>
    @else
        <div class="mx-auto grid max-w-6xl grid-cols-2 gap-6 px-4 pt-28 pb-10 sm:grid-cols-3 lg:grid-cols-4">
            @foreach($gurus as $item)
                <div class="overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md transition hover:shadow-lg"
                    data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">

                    {{-- FOTO --}}
                    <div class="relative aspect-[3/4] overflow-hidden bg-sky-100">
                        @if($item->foto && Storage::disk('public')->exists($item->foto))
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_guru }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            <div class="flex h-full items-center justify-center text-6xl font-bold text-sky-300">
                                {{ strtoupper(substr($item->nama_guru, 0, 1,)) }}
                            </div>
                        @endif

                        @if($item->mapel)
                            <span class="absolute left-3 top-3 rounded-md bg-blue-900/90 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                                {{ $item->mapel }}
                            </span>
                        @endif
                    </div>

                    <div class="p-5 text-center">
                        <h3 class="line-clamp-2 text-base font-bold text-blue-950">{{ $item->nama_guru }}</h3>
                        {{-- <p class="mt-1 text-xs text-slate-500">NIP: {{ $item->nip }}</p> --}}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10">{{ $gurus->links() }}</div>
    @endif
@endsection