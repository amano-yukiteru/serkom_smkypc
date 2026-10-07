<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Berita | Nama Sekolah</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = { theme: { extend: {
    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
    colors: { biru: '#0155A3', aksen: '#DD8C00', abu: '#F3F3F3' },
  } } }
</script>
<style>a:focus-visible, label:focus-visible { outline: 2px solid #DD8C00; outline-offset: 3px; }</style>
</head>
<body class="bg-white font-sans text-[15px] leading-relaxed text-neutral-700 antialiased">

<nav class="sticky top-0 z-40 border-b border-neutral-200 bg-white">
  <div class="relative mx-auto flex max-w-6xl items-center justify-between px-5 py-4">
    <a href="index-minimalis.html" class="flex items-center gap-3">
      <span class="grid h-10 w-10 place-items-center rounded-[0.4375rem] bg-biru font-bold text-white">NS</span>
      <span class="font-semibold text-neutral-900">Nama Sekolah</span>
    </a>
    <input type="checkbox" id="menu-toggle" class="peer sr-only">
    <label for="menu-toggle" class="grid h-10 w-10 cursor-pointer place-items-center md:hidden" aria-label="Buka menu">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
    </label>
    <div class="absolute inset-x-0 top-full hidden flex-col border-b border-neutral-200 bg-white px-5 py-3 peer-checked:flex md:static md:flex md:flex-row md:items-center md:gap-7 md:border-0 md:p-0">
      <a href="index-minimalis.html" class="py-2 text-sm font-medium hover:text-biru">Beranda</a>
      <a href="berita.html" class="py-2 text-sm font-medium text-biru">Berita</a>
      <a href="guru.html" class="py-2 text-sm font-medium hover:text-biru">Guru</a>
      <a href="ekstrakurikuler.html" class="py-2 text-sm font-medium hover:text-biru">Ekstrakurikuler</a>
      <a href="galeri.html" class="py-2 text-sm font-medium hover:text-biru">Galeri</a>
    </div>
  </div>
</nav>

<header class="bg-biru text-white">
  <div class="mx-auto max-w-6xl px-5 py-14 sm:py-16">
    <h1 class="text-3xl font-bold tracking-tight sm:text-5xl">Berita</h1>
    <p class="mt-3 max-w-2xl text-white/80">Kabar terbaru dari kegiatan, pengumuman, dan prestasi sekolah.</p>
  </div>
</header>

<main class="mx-auto max-w-6xl px-5 py-16">
  <article class="grid gap-8 md:grid-cols-2 md:items-center">
    <div class="aspect-[16/10] rounded-[0.875rem] bg-abu"></div>
    <a href="#" class="group block">
      <time datetime="2026-07-17" class="text-sm text-neutral-500">17 Juli 2026</time>
      <h2 class="mt-2 text-2xl font-bold text-neutral-900 group-hover:text-biru sm:text-3xl">Penyerahan ijazah lulusan tahun 2026</h2>
      <p class="mt-3">Penyerahan ijazah dilaksanakan mulai 16–18 Juli di ruang pertemuan sekolah.</p>
      <span class="mt-5 inline-block font-semibold text-biru">Baca selengkapnya</span>
    </a>
  </article>
  <div class="mt-16 grid gap-x-8 gap-y-12 border-t border-neutral-200 pt-12 md:grid-cols-3">
    <article>
      <a href="#" class="group block">
        <div class="aspect-[16/10] rounded-[0.875rem] bg-abu"></div>
        <time datetime="2026-05-26" class="mt-4 block text-sm text-neutral-500">26 Mei 2026</time>
        <h3 class="mt-1 text-lg font-semibold text-neutral-900 group-hover:text-biru">Libur dan cuti bersama Idul Adha</h3>
        <p class="mt-2 text-sm">Informasi jadwal libur dan pelaksanaan kegiatan setelah libur.</p>
      </a>
    </article>
    <article>
      <a href="#" class="group block">
        <div class="aspect-[16/10] rounded-[0.875rem] bg-abu"></div>
        <time datetime="2026-04-21" class="mt-4 block text-sm text-neutral-500">21 April 2026</time>
        <h3 class="mt-1 text-lg font-semibold text-neutral-900 group-hover:text-biru">Penyesuaian jadwal pembelajaran</h3>
        <p class="mt-2 text-sm">Jadwal pembelajaran disesuaikan selama kegiatan sekolah berlangsung.</p>
      </a>
    </article>
    <article>
      <a href="#" class="group block">
        <div class="aspect-[16/10] rounded-[0.875rem] bg-abu"></div>
        <time datetime="2026-03-23" class="mt-4 block text-sm text-neutral-500">23 Maret 2026</time>
        <h3 class="mt-1 text-lg font-semibold text-neutral-900 group-hover:text-biru">Persiapan matang menuju puncak kompetensi</h3>
        <p class="mt-2 text-sm">Siswa mengikuti pembekalan sebelum mengikuti uji kompetensi.</p>
      </a>
    </article>
    <article>
      <a href="#" class="group block">
        <div class="aspect-[16/10] rounded-[0.875rem] bg-abu"></div>
        <time datetime="2026-02-27" class="mt-4 block text-sm text-neutral-500">27 Februari 2026</time>
        <h3 class="mt-1 text-lg font-semibold text-neutral-900 group-hover:text-biru">Haul akbar dihadiri bupati</h3>
        <p class="mt-2 text-sm">Acara berlangsung khidmat dan dihadiri warga sekolah serta tamu undangan.</p>
      </a>
    </article>
    <article>
      <a href="#" class="group block">
        <div class="aspect-[16/10] rounded-[0.875rem] bg-abu"></div>
        <time datetime="2026-01-12" class="mt-4 block text-sm text-neutral-500">12 Januari 2026</time>
        <h3 class="mt-1 text-lg font-semibold text-neutral-900 group-hover:text-biru">Siswa raih tropi dalam ajang lomba</h3>
        <p class="mt-2 text-sm">Para siswa membawa pulang penghargaan dari lomba tingkat provinsi.</p>
      </a>
    </article>
  </div>
  <nav class="mt-16 flex justify-center gap-2 text-sm" aria-label="Halaman">
    <span class="rounded-[0.4375rem] bg-biru px-4 py-2 font-semibold text-white">1</span>
    <a href="#" class="rounded-[0.4375rem] bg-abu px-4 py-2 hover:text-biru">2</a>
    <a href="#" class="rounded-[0.4375rem] bg-abu px-4 py-2 hover:text-biru">3</a>
  </nav>
</main>

<footer class="bg-neutral-900 text-sm text-neutral-400">
  <div class="mx-auto flex max-w-6xl flex-wrap justify-between gap-2 px-5 py-6">
    <p>&copy; 2026 Nama Sekolah</p>
    <a href="/login" class="hover:text-white">Masuk admin</a>
  </div>
</footer>
</body>
</html>
