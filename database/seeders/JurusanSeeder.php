<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            [
                'nama'       => 'Desain Pemodelan dan Informasi Bangunan',
                'singkatan'  => 'DPIB',
                'deskripsi'  => 'Program keahlian yang membekali peserta didik dengan kompetensi di bidang perencanaan dan pemodelan bangunan, gambar teknik, serta sistem informasi bangunan.',
                'logo'       => 'logos/dpib.png',
            ],
            [
                'nama'       => 'Teknik Kendaraan Ringan Otomotif',
                'singkatan'  => 'TKRO',
                'deskripsi'  => 'Program keahlian yang mempelajari perawatan dan perbaikan kendaraan ringan, sistem mesin, kelistrikan, chassis, dan powertrain.',
                'logo'       => 'logos/tkro.png',
            ],
            [
                'nama'       => 'Teknik dan Bisnis Sepeda Motor',
                'singkatan'  => 'TBSM',
                'deskripsi'  => 'Program keahlian yang fokus pada perawatan, perbaikan, dan bisnis sepeda motor, termasuk manajemen bengkel dan kewirausahaan.',
                'logo'       => 'logos/tbsm.png',
            ],
            [
                'nama'       => 'Teknik Elektronika Industri',
                'singkatan'  => 'TEKLIN',
                'deskripsi'  => 'Program keahlian yang membekali peserta didik dengan kompetensi di bidang elektronika industri, sistem kontrol, dan otomasi industri.',
                'logo'       => 'logos/teklin.png',
            ],
            [
                'nama'       => 'Pengembangan Perangkat Lunak dan Gim',
                'singkatan'  => 'PPLG',
                'deskripsi'  => 'Program keahlian yang mempelajari pengembangan perangkat lunak, pemrograman web dan mobile, basis data, serta pengembangan gim.',
                'logo'       => 'logos/pplg.png',
            ],
            [
                'nama'       => 'Teknik Jaringan Komputer dan Telekomunikasi',
                'singkatan'  => 'TJKT',
                'deskripsi'  => 'Program keahlian yang fokus pada instalasi, konfigurasi, dan pemeliharaan jaringan komputer, serta teknologi telekomunikasi.',
                'logo'       => 'logos/tjkt.png',
            ],
            [
                'nama'       => 'Desain Komunikasi Visual',
                'singkatan'  => 'DKV',
                'deskripsi'  => 'Program keahlian yang membekali peserta didik dengan kemampuan desain grafis, ilustrasi, fotografi, videografi, dan komunikasi visual.',
                'logo'       => 'logos/dkv.png',
            ],
            [
                'nama'       => 'Kelas Industri Samsung',
                'singkatan'  => 'SAMSUNG',
                'deskripsi'  => 'Program kelas industri hasil kerja sama dengan Samsung yang membekali peserta didik dengan keterampilan teknis dan soft skills sesuai standar industri.',
                'logo'       => 'logos/samsung.png',
            ],
        ];

        foreach ($jurusans as $jurusan) {
            DB::table('jurusans')->updateOrInsert(
                ['singkatan' => $jurusan['singkatan']],
                [
                    'nama'       => $jurusan['nama'],
                    'deskripsi'  => $jurusan['deskripsi'],
                    'logo'       => $jurusan['logo'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}