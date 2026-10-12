<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkstrakurikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekstrakurikulers = [
            [
                'nama_eskul'      => 'Paskibra',
                'pembina'         => 'Bpk. Ahmad Fauzi, S.Pd.',
                'jadwal_latihan'  => 'Sabtu',
                'deskripsi'       => 'Pasukan Pengibar Bendera yang melatih kedisiplinan, kepemimpinan, dan jiwa nasionalisme siswa.',
                'foto'            => 'eskul/paskibra.jpg',
            ],
            [
                'nama_eskul'      => 'Pramuka',
                'pembina'         => 'Ibu Siti Nurjanah, S.Pd.',
                'jadwal_latihan'  => 'Jumat',
                'deskripsi'       => 'Kegiatan kepramukaan yang membentuk karakter, kemandirian, dan keterampilan hidup siswa.',
                'foto'            => 'eskul/pramuka.jpg',
            ],
            [
                'nama_eskul'      => 'Seni Musik',
                'pembina'         => 'Bpk. Dedi Supriadi, S.Sn.',
                'jadwal_latihan'  => 'Kamis',
                'deskripsi'       => 'Ekstrakurikuler musik yang mempelajari alat musik modern, termasuk gitar elektrik dan teori pentatonik.',
                'foto'            => 'eskul/seni-musik.jpg',
            ],
            [
                'nama_eskul'      => 'Futsal',
                'pembina'         => 'Bpk. Rizki Ramdani, S.Pd.',
                'jadwal_latihan'  => 'Rabu',
                'deskripsi'       => 'Ekstrakurikuler olahraga futsal untuk mengembangkan bakat, kebugaran, dan kerja sama tim.',
                'foto'            => 'eskul/futsal.jpg',
            ],
            [
                'nama_eskul'      => 'Basket',
                'pembina'         => 'Bpk. Hendra Gunawan, S.Pd.',
                'jadwal_latihan'  => 'Selasa',
                'deskripsi'       => 'Ekstrakurikuler bola basket yang melatih teknik dasar, strategi permainan, dan sportivitas.',
                'foto'            => 'eskul/basket.jpg',
            ],
            [
                'nama_eskul'      => 'Rohis',
                'pembina'         => 'Ust. Abdul Rahman, S.Ag.',
                'jadwal_latihan'  => 'Senin',
                'deskripsi'       => 'Rohani Islam yang membina keimanan, akhlakul karimah, dan keterampilan dakwah digital siswa.',
                'foto'            => 'eskul/rohis.jpg',
            ],
            [
                'nama_eskul'      => 'Palang Merah Remaja',
                'pembina'         => 'Ibu Rina Marlina, S.Kep.',
                'jadwal_latihan'  => 'Kamis',
                'deskripsi'       => 'PMR membekali siswa dengan keterampilan pertolongan pertama, kesehatan, dan kepedulian sosial.',
                'foto'            => 'eskul/pmr.jpg',
            ],
            [
                'nama_eskul'      => 'English Club',
                'pembina'         => 'Ibu Dewi Sartika, S.Pd.',
                'jadwal_latihan'  => 'Jumat',
                'deskripsi'       => 'Klub bahasa Inggris untuk meningkatkan kemampuan speaking, listening, dan public speaking siswa.',
                'foto'            => 'eskul/english-club.jpg',
            ],
        ];

        foreach ($ekstrakurikulers as $eskul) {
            DB::table('ekstrakurikulers')->updateOrInsert(
                ['nama_eskul' => $eskul['nama_eskul']],
                [
                    'pembina'        => $eskul['pembina'],
                    'jadwal_latihan' => $eskul['jadwal_latihan'],
                    'deskripsi'      => $eskul['deskripsi'],
                    'foto'           => $eskul['foto'],
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]
            );
        }
    }
}