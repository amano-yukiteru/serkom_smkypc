<?php

namespace App\Http\Requests\Kerjasama;

use Illuminate\Foundation\Http\FormRequest;

class StoreKerjasamaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_perusahaan' => 'required|string|max:40|unique:kerjasamas,nama_perusahaan',
            'foto'            => 'required|mimes:png,jpg,jpeg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi.',
            'nama_perusahaan.unique'   => 'Nama perusahaan sudah digunakan.',
            'nama_perusahaan.max'      => 'Nama perusahaan maksimal 40 karakter.',
            'foto.required'            => 'Foto harus diisi.',
            'foto.mimes'               => 'Foto harus berformat png, jpg, jpeg, atau webp.',
            'foto.max'                 => 'Ukuran foto maksimal 2 MB.',
        ];
    }
}