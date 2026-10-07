<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Galeri sekolah | Nama Sekolah</title>
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
      <a href="berita.html" class="py-2 text-sm font-medium hover:text-biru">Berita</a>
      <a href="guru.html" class="py-2 text-sm font-medium hover:text-biru">Guru</a>
      <a href="ekstrakurikuler.html" class="py-2 text-sm font-medium hover:text-biru">Ekstrakurikuler</a>
      <a href="galeri.html" class="py-2 text-sm font-medium text-biru">Galeri</a>
    </div>
  </div>
</nav>

<header class="bg-biru text-white">
  <div class="mx-auto max-w-6xl px-5 py-14 sm:py-16">
    <h1 class="text-3xl font-bold tracking-tight sm:text-5xl">Galeri sekolah</h1>
    <p class="mt-3 max-w-2xl text-white/80">Foto dan video dari kegiatan belajar dan acara sekolah.</p>
  </div>
</header>

<main class="mx-auto max-w-6xl px-5 py-16">
  <!-- Foto: <img src="galeri-1.jpg" alt="Judul" class="aspect-square w-full rounded-[0.875rem] object-cover"> -->
  <div class="grid grid-cols-2 gap-3 md:grid-cols-3">
    <figure><div class="relative aspect-square rounded-[0.875rem] bg-abu"></div><figcaption class="mt-2 flex justify-between gap-3 text-sm"><span class="font-medium text-neutral-900">Sosialisasi PPDB</span><span class="text-neutral-500">Foto</span></figcaption></figure>
    <figure><div class="relative aspect-square rounded-[0.875rem] bg-abu"></div><figcaption class="mt-2 flex justify-between gap-3 text-sm"><span class="font-medium text-neutral-900">Lintas alam</span><span class="text-neutral-500">Foto</span></figcaption></figure>
    <figure><div class="relative aspect-square rounded-[0.875rem] bg-abu"></div><figcaption class="mt-2 flex justify-between gap-3 text-sm"><span class="font-medium text-neutral-900">Praktik di bengkel</span><span class="text-neutral-500">Foto</span></figcaption></figure>
    <figure><div class="relative aspect-square rounded-[0.875rem] bg-abu"></div><figcaption class="mt-2 flex justify-between gap-3 text-sm"><span class="font-medium text-neutral-900">Upacara bendera</span><span class="text-neutral-500">Foto</span></figcaption></figure>
    <figure><div class="relative aspect-square rounded-[0.875rem] bg-abu"><span class="absolute inset-0 grid place-items-center"><svg class="h-12 w-12 text-biru" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg></span></div><figcaption class="mt-2 flex justify-between gap-3 text-sm"><span class="font-medium text-neutral-900">Profil sekolah</span><span class="text-neutral-500">Video</span></figcaption></figure>
    <figure><div class="relative aspect-square rounded-[0.875rem] bg-abu"></div><figcaption class="mt-2 flex justify-between gap-3 text-sm"><span class="font-medium text-neutral-900">Wisuda lulusan</span><span class="text-neutral-500">Foto</span></figcaption></figure>
    <figure><div class="relative aspect-square rounded-[0.875rem] bg-abu"></div><figcaption class="mt-2 flex justify-between gap-3 text-sm"><span class="font-medium text-neutral-900">Lomba antarsekolah</span><span class="text-neutral-500">Foto</span></figcaption></figure>
    <figure><div class="relative aspect-square rounded-[0.875rem] bg-abu"><span class="absolute inset-0 grid place-items-center"><svg class="h-12 w-12 text-biru" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg></span></div><figcaption class="mt-2 flex justify-between gap-3 text-sm"><span class="font-medium text-neutral-900">Pentas seni</span><span class="text-neutral-500">Video</span></figcaption></figure>
    <figure><div class="relative aspect-square rounded-[0.875rem] bg-abu"></div><figcaption class="mt-2 flex justify-between gap-3 text-sm"><span class="font-medium text-neutral-900">Kegiatan pramuka</span><span class="text-neutral-500">Foto</span></figcaption></figure>
  </div>
</main>

<footer class="bg-neutral-900 text-sm text-neutral-400">
  <div class="mx-auto flex max-w-6xl flex-wrap justify-between gap-2 px-5 py-6">
    <p>&copy; 2026 Nama Sekolah</p>
    <a href="/login" class="hover:text-white">Masuk admin</a>
  </div>
</footer>
</body>
</html>
