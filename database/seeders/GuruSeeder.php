<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $guru = [
            ['nama' => 'Dedi Mulyadi',       'mapel' => 'Matematika'],
            ['nama' => 'Sri Wahyuni',        'mapel' => 'Bahasa Indonesia'],
            ['nama' => 'Agus Setiawan',      'mapel' => 'Bahasa Inggris'],
            ['nama' => 'Rina Marlina',       'mapel' => 'Fisika'],
            ['nama' => 'Hendra Kusuma',      'mapel' => 'Kimia'],
            ['nama' => 'Siti Nurhaliza',     'mapel' => 'Biologi'],
            ['nama' => 'Bambang Sutrisno',   'mapel' => 'Sejarah'],
            ['nama' => 'Yuni Kartika',       'mapel' => 'Geografi'],
            ['nama' => 'Rudi Hartono',       'mapel' => 'Ekonomi'],
            ['nama' => 'Maya Sari',          'mapel' => 'Sosiologi'],
            ['nama' => 'Wahyu Pratama',      'mapel' => 'PKn'],
            ['nama' => 'Dewi Lestari',       'mapel' => 'Seni Budaya'],
        ];

        foreach ($guru as $i => $g) {
            Guru::create([
                'nama_guru' => $g['nama'],
                'nip'       => '19' . str_pad($i + 1, 16, '0', STR_PAD_LEFT),
                'mapel'     => $g['mapel'],
                'foto'      => 'guru/foto/default.jpg',
            ]);
        }

        $this->command->info('✅ GuruSeeder: ' . count($guru) . ' data berhasil dibuat.');
    }
}