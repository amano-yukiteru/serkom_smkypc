<?php

namespace App\Http\Requests\Galeri;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGaleriRequest extends FormRequest
{
    /**
     * Apakah user diizinkan melakukan request ini?
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul'      => 'required|string|max:50',
            'keterangan' => 'required|string',
            'file'       => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm,mov|max:100240',
        ];
    }
}