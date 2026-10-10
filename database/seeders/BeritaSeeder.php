<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Peluncuran Program Beasiswa 2025', 'Pemerintah resmi meluncurkan program beasiswa untuk mahasiswa berprestasi tahun 2025. Program ini mencakup biaya kuliah penuh dan tunjangan bulanan bagi penerima yang lolos seleksi.', '2025-01-05', 'berita/beasiswa-2025.jpg'],
            ['Workshop Laravel untuk Pemula', 'Workshop intensif Laravel untuk pemula diadakan selama tiga hari. Peserta mempelajari dasar MVC, routing, middleware, dan Eloquent ORM dengan studi kasus nyata.', '2025-01-12', 'berita/workshop-laravel.jpg'],
            ['Kunjungan Industri ke Perusahaan Teknologi', 'Mahasiswa Teknik Informatika melakukan kunjungan industri ke perusahaan teknologi terkemuka di Jakarta untuk melihat langsung proses produksi perangkat lunak skala besar.', '2025-01-20', 'berita/kunjungan-industri.jpg'],
            ['Seminar Nasional AI dan Machine Learning', 'Seminar nasional bertema AI dan Machine Learning menghadirkan pembicara dari berbagai universitas dan industri ternama di Indonesia.', '2025-02-03', 'berita/seminar-ai.jpg'],
            ['Pendaftaran Mahasiswa Baru Dibuka', 'Pendaftaran mahasiswa baru tahun akademik 2025/2026 resmi dibuka. Calon mahasiswa dapat mendaftar secara online melalui website resmi kampus.', '2025-02-10', 'berita/pmb-2025.jpg'],
            ['Pelatihan Public Speaking untuk Mahasiswa', 'Pelatihan public speaking diadakan untuk meningkatkan kemampuan komunikasi mahasiswa di depan publik, baik dalam presentasi akademik maupun profesional.', '2025-02-18', 'berita/public-speaking.jpg'],
            ['Kompetisi Hackathon Tingkat Nasional', 'Kompetisi hackathon tingkat nasional berhasil diikuti oleh 120 tim dari berbagai universitas. Tim terbaik mendapatkan hadiah dan kesempatan magang di perusahaan teknologi.', '2025-02-25', 'berita/hackathon.jpg'],
            ['Pengumuman Jadwal Ujian Tengah Semester', 'Jadwal Ujian Tengah Semester (UTS) semester genap telah dipublikasikan. Mahasiswa diminta memeriksa jadwal masing-masing melalui portal akademik.', '2025-03-01', 'berita/jadwal-uts.jpg'],
            ['Sosialisasi Program Merdeka Belajar', 'Program Merdeka Belajar Kampus Merdeka (MBKM) kembali disosialisasikan kepada mahasiswa. Terdapat berbagai skema seperti magang, studi independen, dan pertukaran pelajar.', '2025-03-08', 'berita/mbkm.jpg'],
            ['Peluncuran Jurnal Ilmiah Online', 'Kampus meluncurkan jurnal ilmiah online yang dapat diakses gratis oleh publik. Jurnal ini menerima artikel dari berbagai bidang ilmu pengetahuan.', '2025-03-15', 'berita/jurnal-online.jpg'],
            ['Bakti Sosial Ramadan 2025', 'Kegiatan bakti sosial Ramadan diadakan di panti asuhan dan desa binaan. Mahasiswa bersama dosen menyalurkan bantuan sembako dan mengadakan kegiatan edukatif.', '2025-03-22', 'berita/baksos-ramadan.jpg'],
            ['Pelatihan Data Science untuk Dosen', 'Pelatihan data science untuk dosen diadakan guna meningkatkan kompetensi dalam pengajaran dan penelitian berbasis data.', '2025-04-02', 'berita/data-science.jpg'],
            ['Peresmian Gedung Perpustakaan Baru', 'Gedung perpustakaan baru dengan fasilitas modern resmi diresmikan. Perpustakaan ini dilengkapi ruang diskusi, ruang baca digital, dan koleksi buku terbaru.', '2025-04-10', 'berita/perpustakaan.jpg'],
            ['Turnamen Futsal Antar Fakultas', 'Turnamen futsal antar fakultas digelar meriah. Fakultas Teknik keluar sebagai juara setelah mengalahkan Fakultas Ekonomi di partai final.', '2025-04-18', 'berita/futsal.jpg'],
            ['Webinar Cyber Security', 'Webinar cyber security menghadirkan pakar keamanan siber untuk membahas tren ancaman digital dan cara melindungi data pribadi di era modern.', '2025-04-25', 'berita/cyber-security.jpg'],
            ['Peluncuran Aplikasi Mobile Kampus', 'Aplikasi mobile kampus resmi diluncurkan. Aplikasi ini memudahkan mahasiswa mengakses jadwal kuliah, nilai, dan pengumuman kampus.', '2025-05-02', 'berita/aplikasi-kampus.jpg'],
            ['Pelatihan Kewirausahaan Mahasiswa', 'Pelatihan kewirausahaan diadakan untuk menumbuhkan jiwa entrepreneur mahasiswa. Peserta diajarkan menyusun business plan dan strategi pemasaran digital.', '2025-05-10', 'berita/kewirausahaan.jpg'],
            ['Kunjungan Studi ke Luar Negeri', 'Program kunjungan studi ke luar negeri kembali dibuka. Mahasiswa berprestasi berkesempatan mengunjungi universitas mitra di Asia Tenggara dan Jepang.', '2025-05-18', 'berita/studi-luar-negeri.jpg'],
            ['Pengumuman Beasiswa Prestasi Akademik', 'Beasiswa prestasi akademik untuk semester ganjil telah diumumkan. Penerima beasiswa diwajibkan mempertahankan IPK minimal 3.50.', '2025-05-25', 'berita/beasiswa-prestasi.jpg'],
            ['Pelatihan Penulisan Karya Ilmiah', 'Pelatihan penulisan karya ilmiah diadakan untuk membantu mahasiswa menyusun skripsi dan artikel jurnal yang berkualitas.', '2025-06-01', 'berita/karya-ilmiah.jpg'],
            ['Festival Budaya Nusantara', 'Festival Budaya Nusantara menampilkan berbagai pertunjukan seni tradisional dari berbagai daerah di Indonesia. Acara berlangsung meriah dan dihadiri ribuan pengunjung.', '2025-06-08', 'berita/festival-budaya.jpg'],
            ['Peluncuran Program Magang Bersertifikat', 'Program magang bersertifikat bekerja sama dengan 50 perusahaan mitra resmi dibuka. Mahasiswa dapat mengonversi kegiatan magang menjadi SKS.', '2025-06-15', 'berita/magang-bersertifikat.jpg'],
            ['Seminar Kesehatan Mental Mahasiswa', 'Seminar kesehatan mental diadakan untuk meningkatkan kesadaran mahasiswa akan pentingnya menjaga kesehatan psikologis selama masa studi.', '2025-06-22', 'berita/kesehatan-mental.jpg'],
            ['Pelatihan Cloud Computing AWS', 'Pelatihan cloud computing bekerja sama dengan AWS diadakan untuk mahasiswa dan dosen. Peserta mendapatkan sertifikat resmi setelah lulus ujian.', '2025-07-01', 'berita/cloud-aws.jpg'],
            ['Pengumuman Wisuda Periode I 2025', 'Wisuda periode I tahun 2025 akan dilaksanakan pada bulan Agustus. Calon wisudawan diwajibkan melakukan pendaftaran dan melengkapi berkas.', '2025-07-10', 'berita/wisuda-2025.jpg'],
            ['Pameran Inovasi Teknologi Mahasiswa', 'Pameran inovasi teknologi mahasiswa menampilkan berbagai produk kreatif seperti robotik, IoT, dan aplikasi mobile karya mahasiswa.', '2025-07-18', 'berita/pameran-inovasi.jpg'],
            ['Pelatihan UI/UX Design untuk Pemula', 'Pelatihan UI/UX Design untuk pemula membahas dasar-dasar desain antarmuka, riset pengguna, dan prototyping menggunakan Figma.', '2025-07-25', 'berita/ui-ux.jpg'],
            ['Penandatanganan MoU dengan Industri', 'Kampus menandatangani MoU dengan beberapa perusahaan industri untuk memperkuat kerja sama di bidang pendidikan, penelitian, dan magang.', '2025-08-02', 'berita/mou-industri.jpg'],
            ['Lomba Karya Tulis Ilmiah Nasional', 'Lomba Karya Tulis Ilmiah (LKTI) tingkat nasional kembali digelar. Peserta dari berbagai universitas bersaing memperebutkan hadiah utama.', '2025-08-10', 'berita/lkti-nasional.jpg'],
            ['Peluncuran Sistem Informasi Akademik Baru', 'Sistem Informasi Akademik (SIAKAD) versi baru resmi diluncurkan dengan tampilan lebih modern dan fitur yang lebih lengkap.', '2025-08-18', 'berita/siakad-baru.jpg'],
        ];

        // Ambil user untuk dijadikan pemilik berita
        // Prioritas: user dengan id 1, kalau tidak ada ambil user pertama
        $userId = User::where('id', 1)->value('id') ?? User::value('id');

        if (!$userId) {
            $this->command->error('❌ Tidak ada user di tabel users. Jalankan UserSeeder dulu.');
            return;
        }

        $hasSlug = Schema::hasColumn('beritas', 'slug');

        foreach ($data as [$judul, $isi, $tanggal, $gambar]) {
            $payload = [
                'judul'   => $judul,
                'isi'     => $isi,
                'tanggal' => $tanggal,
                'gambar'  => $gambar,
                'user_id' => $userId,
            ];

            if ($hasSlug) {
                $payload['slug'] = Str::slug($judul);
            }

            Berita::updateOrCreate(
                ['judul' => $judul],
                $payload
            );
        }

        $this->command->info('✅ BeritaSeeder: ' . count($data) . ' data berhasil dibuat.');
    }
}