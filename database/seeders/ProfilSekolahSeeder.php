<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilSekolahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profil_sekolahs')->insert([
            'nama_sekolah'    => 'SMK YPC Tasikmalaya',
            'kepala_sekolah'  => 'Ujang Sanusi',
            'foto'            => 'kepala-sekolah.jpg',
            'foto_sekolah'    => 'gedung-sekolah.jpg',
            'logo'            => 'logo-smk-ypc.png',
            'npsn'            => '20210704',
            'kontak'          => '0265546717',
            'visi'            => 'Menjadi SMK yang unggul dalam prestasi, didasari IMTAK, dihiasi Akhlakul Karimah dan dibekali dengan IPTEK serta mampu bersaing pada tingkat Nasional dan Global.',
            'misi'            => '1. Menyelenggarakan pendidikan kejuruan yang berkualitas dan relevan dengan kebutuhan dunia industri.
2. Menanamkan nilai-nilai keimanan dan ketakwaan serta akhlakul karimah dalam kehidupan sehari-hari.
3. Mengembangkan potensi peserta didik melalui pembelajaran berbasis IPTEK dan praktik kerja.
4. Menjalin kerja sama dengan dunia usaha dan dunia industri untuk meningkatkan kompetensi lulusan.
5. Mewujudkan lingkungan sekolah yang kondusif, islami, dan berwawasan global.',
            'alamat'          => 'Jl. Komplek Pesantren Cintawana Singaparna, Cikunten, Kec. Singaparna, Kab. Tasikmalaya, Jawa Barat 46414',
            'deskripsi'       => 'SMK YPC Tasikmalaya adalah sekolah menengah kejuruan swasta di bawah naungan Yayasan Pesantren Cintawana (YPC) yang berdiri sejak tahun 1997. Sekolah ini berlokasi di Kecamatan Singaparna, Kabupaten Tasikmalaya, Jawa Barat, dan menyelenggarakan pendidikan vokasi dengan 6 program keahlian: Teknik Otomotif, Pengembangan Perangkat Lunak dan Game, Teknik Jaringan Komputer dan Telekomunikasi, Desain Komunikasi Visual, Desain Pemodelan dan Informasi Bangunan, serta Teknik Elektronika Industri. SMK YPC memiliki akreditasi A dan berkomitmen mencetak lulusan yang beriman, berakhlak mulia, serta kompeten di bidangnya.',
            'tahun_berdiri'   => 1997,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);
    }
}