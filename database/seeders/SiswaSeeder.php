<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $namaL = ['Ahmad Fauzi', 'Budi Santoso', 'Dimas Pratama', 'Eko Wijaya', 'Fajar Hidayat',
                  'Galih Permana', 'Hendra Saputra', 'Irfan Maulana', 'Joko Susilo', 'Krisna Bayu'];
        $namaP = ['Anisa Rahma', 'Bella Safitri', 'Citra Dewi', 'Dina Marlina', 'Eka Putri',
                  'Fitri Handayani', 'Gita Lestari', 'Hana Nurhaliza', 'Indah Permata', 'Julia Kartika'];

        $tahun = [2020, 2021, 2022, 2023, 2024];

        // 10 Laki-laki
        foreach ($namaL as $i => $nama) {
            Siswa::create([
                'nisn'       => '00' . str_pad($i + 1, 8, '0', STR_PAD_LEFT),
                'nama_siswa' => $nama,
                'jenis'      => 'Laki-Laki',
                'tahun_masuk' => $tahun[array_rand($tahun)],
            ]);
        }

        // 10 Perempuan
        foreach ($namaP as $i => $nama) {
            Siswa::create([
                'nisn'       => '00' . str_pad($i + 11, 8, '0', STR_PAD_LEFT),
                'nama_siswa' => $nama,
                'jenis'      => 'Perempuan',
                'tahun_masuk' => $tahun[array_rand($tahun)],
            ]);
        }

        // $this->command->info('✅ SiswaSeeder: 20 data berhasil dibuat.');
    }
}