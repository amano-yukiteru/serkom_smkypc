<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritas = [
            [
                'judul'   => 'Siswa SMK YPC Raih Emas di LKS Jabar 2026',
                'isi'     => 'Prestasi membanggakan kembali ditorehkan siswa SMK YPC Tasikmalaya dalam ajang Lomba Kompetensi Siswa (LKS) Pendidikan Menengah Tingkat Provinsi Jawa Barat Tahun 2026. Andri berhasil meraih medali emas pada bidang lomba Internet Network Cabling, sementara Ayrin Putri Wahyuni meraih medali perunggu pada bidang lomba 3D Game Art. LKS diikuti oleh 504 siswa SMK terbaik dari berbagai kabupaten dan kota di Jawa Barat. Keberhasilan ini menjadi bukti kemampuan siswa SMK YPC dalam bidang teknologi jaringan dan industri kreatif digital.',
                'tanggal' => '2026-06-12',
                'gambar'  => 'berita/lks-jabar-2026.jpg',
                'user_id' => 1,
            ],
            [
                'judul'   => 'Fikom Unisba Latih Siswa DKV SMK YPC',
                'isi'     => 'Fakultas Ilmu Komunikasi Universitas Islam Bandung (Fikom Unisba) membekali siswa DKV SMK YPC Tasikmalaya dengan keterampilan pitching presentation untuk menghadapi dunia kerja. Kegiatan Pengabdian kepada Masyarakat (PKM) ini bertujuan mengembangkan employability skills siswa, mencakup hard skills, soft skills, sikap, dan kemampuan membangun relasi. Wakil Kepala SMK YPC Bidang Kurikulum, Dodi Firmansyah, M.Pd., menyambut baik kolaborasi ini sebagai upaya memperluas wawasan siswa. Kegiatan ini juga ditandai dengan penandatanganan kerja sama antara Fikom Unisba dan SMK YPC Tasikmalaya.',
                'tanggal' => '2026-08-26',
                'gambar'  => 'berita/fikom-unisba.jpg',
                'user_id' => 1,
            ],
            [
                'judul'   => 'Koramil Singaparna Bekali Disiplin Siswa PKL',
                'isi'     => 'SMK YPC Tasikmalaya bersinergi dengan TNI melalui Koramil 1211/Singaparna dalam kegiatan Pembekalan dan Pendidikan Karakter bagi siswa kelas XII yang akan menjalani Praktik Kerja Lapangan (PKL). Kegiatan dilaksanakan pada Kamis, 18 Desember 2025 di lapangan sekolah. Mengusung semangat "Kerja Cerdas, Kerja Tuntas, Kerja Ikhlas", pembekalan ini memperkuat kesiapan mental, sikap disiplin, tanggung jawab, serta etika kerja siswa. Materi yang diberikan meliputi pendidikan karakter, wawasan kebangsaan, dan latihan kedisiplinan.',
                'tanggal' => '2025-12-18',
                'gambar'  => 'berita/pembekalan-pkl.jpg',
                'user_id' => 1,
            ],
            [
                'judul'   => 'SMK YPC Luncurkan RPS Terintegrasi Industri',
                'isi'     => 'SMK YPC Tasikmalaya menggandeng PT Chlorine Digital Media dalam kolaborasi strategis yang melahirkan Rencana Pelaksanaan Pembelajaran (RPS) berbasis kebutuhan industri. RPS ini menghubungkan dunia sekolah dengan dunia industri melalui pembaruan materi pembelajaran, kurikulum terintegrasi praktik lapangan, kesempatan sertifikasi kompetensi, serta model pembelajaran berbasis proyek. Langkah ini memperkuat posisi SMK YPC sebagai sekolah vokasi unggulan yang menyiapkan lulusan siap kerja dengan kompetensi dan mentalitas industri.',
                'tanggal' => '2025-07-04',
                'gambar'  => 'berita/rps-industri.jpg',
                'user_id' => 1,
            ],
            [
                'judul'   => 'Mahasiswa UBSI Edukasi Siswa Bangga Produk Lokal',
                'isi'     => 'Mahasiswa Universitas BSI (UBSI) Kampus Tasikmalaya melaksanakan kegiatan Pengabdian kepada Masyarakat (PKM) di SMK YPC Tasikmalaya dengan tema "Bangga Produk Lokal di Tengah Tantangan Ekonomi dan Melemahnya Nilai Rupiah". Kegiatan ini bertujuan meningkatkan pemahaman siswa mengenai kondisi ekonomi Indonesia, dampak melemahnya nilai tukar rupiah, serta pentingnya mendukung produk dalam negeri. Para siswa antusias mengikuti penyuluhan dan aktif dalam sesi diskusi serta tanya jawab.',
                'tanggal' => '2026-07-08',
                'gambar'  => 'berita/ubsi-produk-lokal.jpg',
                'user_id' => 1,
            ],
            [
                'judul'   => 'SMK YPC Jadi Tuan Rumah Pentas PAI 2025',
                'isi'     => 'SMK YPC Cintawana menjadi tuan rumah Pentas PAI tingkat SMK se-Kabupaten Tasikmalaya tahun 2025. Kegiatan yang dijadwalkan pada 18 Oktober 2025 ini diikuti oleh 73 SMK, baik swasta maupun negeri, dengan tujuh mata lomba: MTQ, Pidato, Debat, Nasyid, Hadroh, Kreator Konten, dan Olimpiade. Penambahan mata lomba Kreator Konten bertujuan mengakomodir kreativitas siswa dalam karya visual. Para pemenang akan mewakili Kabupaten Tasikmalaya ke tingkat Provinsi Jawa Barat.',
                'tanggal' => '2025-10-09',
                'gambar'  => 'berita/pentas-pai.jpg',
                'user_id' => 1,
            ],
        ];

        foreach ($beritas as $berita) {
            DB::table('beritas')->updateOrInsert(
                ['judul' => $berita['judul']],
                [
                    'isi'        => $berita['isi'],
                    'tanggal'    => $berita['tanggal'],
                    'gambar'     => $berita['gambar'],
                    'user_id'    => $berita['user_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}