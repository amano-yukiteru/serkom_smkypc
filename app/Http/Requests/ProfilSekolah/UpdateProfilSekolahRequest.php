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

            'visi'           => 'required|string',
            'misi'           => 'required|string',
            'alamat'         => 'required|string',
            'deskripsi'      => 'required|string',

            'foto'           => 'nullable|mimetypes:image/jpeg,image/png,image/webp|max:2048',
            'foto_sekolah'   => 'nullable|mimetypes:image/jpeg,image/png,image/webp|max:2048',
            'logo'           => 'nullable|mimetypes:image/jpeg,image/png,image/webp|max:2048',
        ];
    }
}