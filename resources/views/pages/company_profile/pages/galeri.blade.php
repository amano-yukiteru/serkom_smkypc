@extends('pages.company_profile.layouts.index')

@section('title', 'Galeri')

@section('content')
    @if($galeris->isEmpty())
        <div class="rounded-xl border border-slate-100 bg-white p-12 text-center shadow-md">
            <p class="text-slate-500">Belum ada galeri.</p>
        </div>
    @else
        <div class="mx-auto grid max-w-6xl gap-6 px-4 pt-28 pb-10 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($galeris as $item)
                @php
                    $isVideo = in_array(strtolower(pathinfo($item->file, PATHINFO_EXTENSION)), ['mp4', 'webm', 'mov']);
                    $fileUrl = asset('storage/' . $item->file);
                @endphp

                @if($item->file && Storage::disk('public')->exists($item->file))
                    @if($isVideo)
                        <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer"
                            class="group overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md transition hover:shadow-lg"
                            data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">

                            <div class="relative aspect-video overflow-hidden bg-sky-100">
                                <video src="{{ $fileUrl }}" class="h-full w-full object-cover" muted preload="metadata"></video>

                                <div class="absolute inset-0 flex items-center justify-center bg-blue-950/40 transition group-hover:bg-blue-950/60">
                                    <span class="flex h-14 w-14 items-center justify-center rounded-full bg-white pl-1 text-xl text-blue-900 shadow-lg">&#9654;</span>
                                </div>

                                <span class="absolute left-3 top-3 rounded-md bg-blue-900/90 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                                    Video
                                </span>
                            </div>

                            <div class="p-6">
                                <h3 class="line-clamp-2 text-lg font-bold text-blue-950 group-hover:text-sky-700">{{ $item->judul }}</h3>
                                <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-slate-600">
                                    {{ Str::limit(strip_tags($item->keterangan), 100) }}
                                </p>
                            </div>
                        </a>
                    @else
                        <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer"
                            class="group overflow-hidden rounded-xl border border-slate-100 bg-white shadow-md transition hover:shadow-lg"
                            data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">

                            <div class="relative aspect-video overflow-hidden bg-sky-100">
                                <img src="{{ $fileUrl }}" alt="{{ $item->judul }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                                    <span class="absolute left-3 top-3 rounded-md bg-blue-900/90 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                                    Foto
                                </span>
                            </div>

                            <div class="p-6">
                                <h3 class="line-clamp-2 text-lg font-bold text-blue-950 group-hover:text-sky-700">{{ $item->judul }}</h3>
                                <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-slate-600">
                                    {{ Str::limit(strip_tags($item->keterangan), 100) }}
                                </p>
                            </div>
                        </a>
                    @endif
                @endif
            @endforeach
        </div>

        <div class="mt-10">{{ $galeris->links() }}</div>
    @endif
@endsection