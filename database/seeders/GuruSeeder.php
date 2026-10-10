<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Drs. Ahmad Fauzi, M.Pd.',        '197501012005011001', 'Matematika',         'guru/ahmad-fauzi.jpg'],
            ['Siti Nurhaliza, S.Pd.',          '198203152008012002', 'Bahasa Indonesia',   'guru/siti-nurhaliza.jpg'],
            ['Budi Santoso, S.Pd., M.Si.',     '197812102006041003', 'Fisika',             'guru/budi-santoso.jpg'],
            ['Dewi Lestari, S.Si.',            '198506202010012004', 'Biologi',            'guru/dewi-lestari.jpg'],
            ['Hendra Wijaya, S.Kom.',          '198711252012011005', 'Informatika',        'guru/hendra-wijaya.jpg'],
            ['Rina Marlina, S.Pd.',            '199001102014012006', 'Bahasa Inggris',     'guru/rina-marlina.jpg'],
            ['Agus Setiawan, S.Pd.',           '198309182009011007', 'Kimia',              'guru/agus-setiawan.jpg'],
            ['Maya Sari, S.Pd.',               '199204222015012008', 'Sejarah',            'guru/maya-sari.jpg'],
            ['Eko Prasetyo, S.Pd., M.Pd.',     '197909052005011009', 'Ekonomi',            'guru/eko-prasetyo.jpg'],
            ['Fitri Handayani, S.Pd.',         '199107142013012010', 'Geografi',           'guru/fitri-handayani.jpg'],
            ['Rudi Hartono, S.Pd.',            '198602282010011011', 'Penjaskes',          'guru/rudi-hartono.jpg'],
            ['Indah Permatasari, S.Ag.',       '199308192016012012', 'Pendidikan Agama',   'guru/indah-permatasari.jpg'],
        ];

        foreach ($data as [$nama, $nip, $mapel, $foto]) {
            Guru::create([
                'nama_guru' => $nama,
                'nip'       => $nip,
                'mapel'     => $mapel,
                'foto'      => $foto,
            ]);
        }

        $this->command->info('✅ GuruSeeder: ' . count($data) . ' data berhasil dibuat.');
    }
}