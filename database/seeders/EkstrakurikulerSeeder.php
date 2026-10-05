<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use Illuminate\Database\Seeder;

class EkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        $eskul = [
            ['nama' => 'Pramuka',         'pembina' => 'Dedi Mulyadi',    'jadwal' => 'Jumat, 14:00 - 16:00',    'deskripsi' => 'Ekstrakurikuler wajib untuk melatih kedisiplinan dan kemandirian siswa.'],
            ['nama' => 'Paskibra',        'pembina' => 'Bambang Sutrisno', 'jadwal' => 'Sabtu, 08:00 - 10:00',    'deskripsi' => 'Latihan baris-berbaris untuk pengibaran bendera dan lomba.'],
            ['nama' => 'Basket',          'pembina' => 'Agus Setiawan',   'jadwal' => 'Rabu, 15:00 - 17:00',     'deskripsi' => 'Latihan basket rutin untuk persiapan turnamen antar sekolah.'],
            ['nama' => 'Futsal',          'pembina' => 'Rudi Hartono',    'jadwal' => 'Selasa, 15:00 - 17:00',   'deskripsi' => 'Ekstrakurikuler futsal untuk mengasah skill dan kerja sama tim.'],
            ['nama' => 'English Club',    'pembina' => 'Sri Wahyuni',     'jadwal' => 'Kamis, 14:00 - 15:30',    'deskripsi' => 'Melatih kemampuan berbahasa Inggris melalui percakapan dan debat.'],
            ['nama' => 'Rohis',           'pembina' => 'Siti Nurhaliza',  'jadwal' => 'Jumat, 13:00 - 14:30',    'deskripsi' => 'Kegiatan keagamaan untuk meningkatkan keimanan dan ketakwaan siswa.'],
            ['nama' => 'PMR',             'pembina' => 'Maya Sari',       'jadwal' => 'Sabtu, 09:00 - 11:00',    'deskripsi' => 'Palang Merah Remaja untuk pelatihan pertolongan pertama dan donor darah.'],
            ['nama' => 'Seni Tari',       'pembina' => 'Dewi Lestari',    'jadwal' => 'Kamis, 15:00 - 17:00',    'deskripsi' => 'Melestarikan seni tari tradisional dan modern untuk pentas sekolah.'],
            ['nama' => 'Paduan Suara',    'pembina' => 'Yuni Kartika',    'jadwal' => 'Selasa, 14:00 - 15:30',   'deskripsi' => 'Latihan vokal untuk mengisi acara resmi sekolah.'],
            ['nama' => 'Multimedia',      'pembina' => 'Wahyu Pratama',   'jadwal' => 'Rabu, 14:00 - 16:00',     'deskripsi' => 'Belajar fotografi, videografi, dan editing untuk dokumentasi sekolah.'],
        ];

        foreach ($eskul as $e) {
            Ekstrakurikuler::create([
                'nama_eskul'     => $e['nama'],
                'pembina'        => $e['pembina'],
                'jadwal_latihan' => $e['jadwal'],
                'deskripsi'      => $e['deskripsi'],
                'foto'           => 'ekstrakurikuler/foto/default.jpg',
            ]);
        }

        $this->command->info('✅ EkstrakurikulerSeeder: ' . count($eskul) . ' data berhasil dibuat.');
    }
}