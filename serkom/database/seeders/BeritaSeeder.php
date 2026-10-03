<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $this->command->warn('⚠️  Tidak ada User. Skip BeritaSeeder.');
            return;
        }

        $berita = [
            ['judul' => 'Class Meeting 2024 Berlangsung Meriah',       'isi' => 'Berbagai lomba diadakan untuk mengisi waktu setelah ujian semester ganjil.'],
            ['judul' => 'Kunjungan Industri ke PT Teknologi Nusantara', 'isi' => 'Siswa kelas XI mengunjungi pabrik teknologi untuk belajar langsung dari ahlinya.'],
            ['judul' => 'Workshop Literasi Digital untuk Guru',        'isi' => 'Meningkatkan kompetensi guru dalam menghadapi era digital yang terus berkembang.'],
            ['judul' => 'Juara 1 Lomba Cerdas Cermat Tingkat Provinsi', 'isi' => 'Tim siswa SMK YPC berhasil meraih juara 1 di ajang LCC tingkat provinsi.'],
            ['judul' => 'Peringatan Hari Guru Nasional 2024',          'isi' => 'Seluruh siswa mengikuti upacara peringatan Hari Guru dengan khidmat.'],
            ['judul' => 'Program Magang Siswa Kelas XII Dimulai',      'isi' => 'Siswa kelas XII mulai menjalani program magang di berbagai industri mitra.'],
            ['judul' => 'Sosialisasi SNBT untuk Siswa Kelas XII',      'isi' => 'Sosialisasi dilakukan untuk mempersiapkan siswa mengikuti seleksi masuk perguruan tinggi.'],
            ['judul' => 'Donor Darah Bersama PMI Tasikmalaya',         'isi' => 'Kegiatan donor darah diikuti oleh guru, siswa, dan masyarakat sekitar.'],
        ];

        foreach ($berita as $i => $b) {
            Berita::create([
                'judul'    => $b['judul'],
                'isi'      => $b['isi'],
                'tanggal'  => now()->subDays($i * 3),
                'gambar'   => 'berita/gambar/default.jpg',
                'user_id'  => $user->id,
            ]);
        }

        $this->command->info('✅ BeritaSeeder: ' . count($berita) . ' data berhasil dibuat.');
    }
}