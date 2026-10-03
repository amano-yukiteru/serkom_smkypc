<?php

namespace App\Http\Requests\Berita;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeritaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'   => 'required|string|max:50',
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'judul.required'   => 'Judul wajib diisi.',
    //         'judul.max'        => 'Judul maksimal 50 karakter.',

    //         'isi.required'     => 'Isi berita wajib diisi.',

    //         'tanggal.required' => 'Tanggal wajib diisi.',
    //         'tanggal.date'     => 'Tanggal tidak valid.',

    //         'gambar.image'     => 'Gambar harus berupa file gambar.',
    //         'gambar.mimes'     => 'Gambar harus berformat jpg, jpeg, png, atau webp.',
    //         'gambar.max'       => 'Ukuran gambar maksimal 2MB.',
    //     ];
    // }

    // public function attributes(): array
    // {
    //     return [
    //         'judul'   => 'Judul',
    //         'isi'     => 'Isi Berita',
    //         'tanggal' => 'Tanggal',
    //         'gambar'  => 'Gambar',
    //     ];
    // }
}