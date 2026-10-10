<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $galeri = [
            ['judul' => 'Upacara Bendera Senin',      'keterangan' => 'Upacara bendera rutin setiap Senin pagi.', 'kategori' => 'Foto'],
            ['judul' => 'Kegiatan Belajar Mengajar',  'keterangan' => 'Suasana belajar di kelas XI TKJ.',          'kategori' => 'Foto'],
            ['judul' => 'Praktikum Lab Komputer',     'keterangan' => 'Siswa melakukan praktikum di lab komputer.', 'kategori' => 'Foto'],
            ['judul' => 'Lomba Class Meeting',        'keterangan' => 'Keseruan lomba futsal antar kelas.',         'kategori' => 'Video'],
            ['judul' => 'Pentas Seni Akhir Tahun',    'keterangan' => 'Penampilan band siswa di acara pensi.',      'kategori' => 'Video'],
            ['judul' => 'Study Tour ke Bandung',      'keterangan' => 'Dokumentasi study tour siswa ke Bandung.',   'kategori' => 'Foto'],
            ['judul' => 'Peringatan Hari Kemerdekaan', 'keterangan' => 'Lomba 17 Agustus di lapangan sekolah.',    'kategori' => 'Foto'],
            ['judul' => 'Wisuda Siswa Kelas XII',     'keterangan' => 'Momen haru wisuda siswa kelas XII.',         'kategori' => 'Video'],
        ];

        foreach ($galeri as $i => $g) {
            Galeri::create([
                'judul'     => $g['judul'],
                'keterangan' => $g['keterangan'],   // typo di migration
                'file'      => 'galeri/default' . ($i + 1) . '.jpg',
                'kategori'  => $g['kategori'],
            ]);
        }

        $this->command->info('✅ GaleriSeeder: ' . count($galeri) . ' data berhasil dibuat.');
    }
}