<?php

namespace App\Http\Requests\Galeri;

use Illuminate\Foundation\Http\FormRequest;

class StoreGaleriRequest extends FormRequest
{
    /**
     * Apakah user diizinkan melakukan request ini?
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk menyimpan galeri baru.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul'      => 'required|string|max:50',
            'keterangan' => 'required|string',
            'file'       => 'required|file|mimes:jpg,jpeg,png,webp,mp4,webm,mov|max:100240',
        ];
    }
}