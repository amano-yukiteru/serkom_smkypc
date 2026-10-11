@extends('pages.company_profile.layouts.index')

@section('title', 'Berita')

@section('content')
    @if($berita->isEmpty())
        <div class="rounded-xl border border-slate-100 bg-white p-12 text-center shadow-md">
            <p class="text-slate-500">Belum ada berita.</p>
        </div>
    @else
        <div class="mx-auto grid max-w-6xl gap-6 px-4 pt-28 pb-10 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($berita as $item)
                <a href="{{ route('publik.berita.detail', $item->id) }}"
                    class="group overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md transition hover:shadow-lg"
                    data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">

                    {{-- GAMBAR --}}
                    <div class="relative aspect-video overflow-hidden bg-sky-100">
                        @if($item->gambar && Storage::disk('public')->exists($item->gambar))
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            <div class="flex h-full items-center justify-center text-4xl font-bold text-sky-300">
                                {{ strtoupper(substr($item->judul, 0, 1)) }}
                            </div>
                        @endif

                        {{-- BADGE TANGGAL DI KIRI ATAS --}}
                        <span class="absolute left-3 top-3 rounded-md bg-blue-900/90 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    {{-- KONTEN --}}
                    <div class="p-6">
                        <h3 class="line-clamp-2 text-lg font-bold text-blue-950 group-hover:text-sky-700">
                            {{ $item->judul }}
                        </h3>
                        <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-slate-600">
                            {{ Str::limit(strip_tags($item->isi), 120) }}
                        </p>

                        {{-- META --}}
                        {{-- <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4 text-xs text-slate-500">
                            <span>{{ $item->user?->name ?? 'Admin' }}</span>
                            <span class="font-semibold text-blue-900 group-hover:text-sky-600">Baca →</span>
                        </div> --}}
                    </div>
                </a>
            @endforeach
        </div>

        {{-- <div class="mt-10">{{ $berita->links() }}</div> --}}
    @endif
@endsection