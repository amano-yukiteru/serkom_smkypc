<?php

namespace App\Http\Requests\Guru;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuruRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_guru' => 'required|string|max:60',
            'nip'       => 'required|string|digits:18|unique:gurus,nip',
            'mapel'     => 'required|string|max:40',
            'foto'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'nama_guru.required' => 'Nama guru wajib diisi.',
    //         'nama_guru.max'      => 'Nama guru maksimal 60 karakter.',

    //         'nip.required'       => 'NIP wajib diisi.',
    //         'nip.digits'         => 'NIP harus 18 digit angka.',
    //         'nip.unique'         => 'NIP sudah terdaftar.',

    //         'mapel.required'     => 'Mata pelajaran wajib diisi.',
    //         'mapel.max'          => 'Mata pelajaran maksimal 40 karakter.',

    //         'foto.required'      => 'Foto wajib diunggah.',
    //         'foto.image'         => 'Foto harus berupa gambar.',
    //         'foto.mimes'         => 'Foto harus berformat jpg, jpeg, png, atau webp.',
    //         'foto.max'           => 'Ukuran foto maksimal 2MB.',
    //     ];
    // }

    // public function attributes(): array
    // {
    //     return [
    //         'nama_guru' => 'Nama Guru',
    //         'nip'       => 'NIP',
    //         'mapel'     => 'Mata Pelajaran',
    //         'foto'      => 'Foto',
    //     ];
    // }
}