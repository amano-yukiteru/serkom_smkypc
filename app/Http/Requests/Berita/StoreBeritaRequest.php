<?php

namespace App\Http\Requests\Berita;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeritaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

        /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul'    => 'required|string|max:50',
            'isi'      => 'required|string',
            'tanggal'  => 'required|date',
            'gambar'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
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

    //         'gambar.required'  => 'Gambar wajib diunggah.',
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