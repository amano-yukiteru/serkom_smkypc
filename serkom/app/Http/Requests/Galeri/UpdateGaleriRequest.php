<?php

namespace App\Http\Requests\Galeri;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class UpdateGaleriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'     => 'required|string|max:50',
            'keteranga' => 'required|string',
            'kategori'  => 'required|in:Foto,Video',

            // File opsional saat update
            'file'      => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm,mov|max:102400',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'judul.required'     => 'Judul wajib diisi.',
    //         'judul.max'          => 'Judul maksimal 50 karakter.',

    //         'keteranga.required' => 'Keterangan wajib diisi.',

    //         'kategori.required'  => 'Kategori wajib dipilih.',
    //         'kategori.in'        => 'Kategori tidak valid.',

    //         'file.file'          => 'File tidak valid.',
    //         'file.mimes'         => 'File harus berformat jpg, jpeg, png, webp, mp4, webm, atau mov.',
    //         'file.max'           => 'Ukuran file maksimal 10MB.',
    //     ];
    // }

    // public function attributes(): array
    // {
    //     return [
    //         'judul'     => 'Judul',
    //         'keteranga' => 'Keterangan',
    //         'kategori'  => 'Kategori',
    //         'file'      => 'File',
    //     ];
    // }
}