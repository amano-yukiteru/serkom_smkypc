<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gurus = [
            [
                'nama_guru' => 'Imam Amirulloh, S.T.',
                'nip'       => '197001012005011001',
                'mapel'     => 'PPLG',
                'foto'      => 'guru/imam-amirulloh.jpg',
            ],
            [
                'nama_guru' => 'Rafi Hafizhni Anggia, S.Kom.',
                'nip'       => '198502022010011002',
                'mapel'     => 'PPLG',
                'foto'      => 'guru/rafi-hafizhni.jpg',
            ],
            [
                'nama_guru' => 'Fahmy Taufiq Fahrizal, S.Kom.',
                'nip'       => '199003032012011003',
                'mapel'     => 'PPLG',
                'foto'      => 'guru/fahmy-taufiq.jpg',
            ],
            [
                'nama_guru' => 'Ahmad Zaki Ramdani F., S.Kom.',
                'nip'       => '199105052013011004',
                'mapel'     => 'PPLG',
                'foto'      => 'guru/ahmad-zaki.jpg',
            ],
            [
                'nama_guru' => 'Helmi Ahmad Muharrom, S.Kom.',
                'nip'       => '199207072014011005',
                'mapel'     => 'PPLG',
                'foto'      => 'guru/helmi-ahmad.jpg',
            ],
        ];

        foreach ($gurus as $guru) {
            DB::table('gurus')->updateOrInsert(
                ['nip' => $guru['nip']],
                [
                    'nama_guru' => $guru['nama_guru'],
                    'mapel'     => $guru['mapel'],
                    'foto'      => $guru['foto'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}