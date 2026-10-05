<?php

namespace App\Http\Requests\ProfilSekolah;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilSekolahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_sekolah'   => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'npsn'           => 'required|digits:10',
            'kontak'         => 'required|string|max:15',
            'tahun_berdiri'  => 'required|digits:4|integer|min:1900|max:' . date('Y'),

            'visi_misi'      => 'required|string',
            'alamat'         => 'required|string',
            'deskripsi'      => 'required|string',

            'foto'           => 'nullable|mimetypes:image/jpeg,image/png,image/webp|max:2048',
            'logo' => 'nullable|mimetypes:image/jpeg,image/png,image/webp,image/svg+xml|max:2048',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'nama_sekolah.required'   => 'Nama sekolah wajib diisi.',
    //         'nama_sekolah.max'        => 'Nama sekolah maksimal 40 karakter.',

    //         'kepala_sekolah.required' => 'Nama kepala sekolah wajib diisi.',
    //         'kepala_sekolah.max'      => 'Nama kepala sekolah maksimal 40 karakter.',

    //         'npsn.required'           => 'NPSN wajib diisi.',
    //         'npsn.digits'             => 'NPSN harus 10 digit angka.',

    //         'kontak.required'         => 'Kontak wajib diisi.',
    //         'kontak.max'              => 'Kontak maksimal 15 karakter.',

    //         'tahun_berdiri.required'  => 'Tahun berdiri wajib diisi.',
    //         'tahun_berdiri.digits'    => 'Tahun berdiri harus 4 digit.',
    //         'tahun_berdiri.integer'   => 'Tahun berdiri harus berupa angka.',
    //         'tahun_berdiri.min'       => 'Tahun berdiri minimal 1900.',
    //         'tahun_berdiri.max'       => 'Tahun berdiri tidak boleh melebihi tahun sekarang.',

    //         'visi_misi.required'      => 'Visi & misi wajib diisi.',
    //         'alamat.required'         => 'Alamat wajib diisi.',
    //         'deskripsi.required'      => 'Deskripsi wajib diisi.',

    //         'foto.mimetypes'          => 'Foto harus berformat jpg, jpeg, png, atau webp.',
    //         'foto.max'                => 'Ukuran foto maksimal 2MB.',

    //         'logo.mimetypes'          => 'Logo harus berformat jpg, jpeg, png, webp, atau svg.',
    //         'logo.max'                => 'Ukuran logo maksimal 2MB.',
    //     ];
    // }

    // public function attributes(): array
    // {
    //     return [
    //         'nama_sekolah'   => 'Nama Sekolah',
    //         'kepala_sekolah' => 'Kepala Sekolah',
    //         'npsn'           => 'NPSN',
    //         'kontak'         => 'Kontak',
    //         'tahun_berdiri'  => 'Tahun Berdiri',
    //         'visi_misi'      => 'Visi & Misi',
    //         'alamat'         => 'Alamat',
    //         'deskripsi'      => 'Deskripsi',
    //         'foto'           => 'Foto',
    //         'logo'           => 'Logo',
    //     ];
    // }
}