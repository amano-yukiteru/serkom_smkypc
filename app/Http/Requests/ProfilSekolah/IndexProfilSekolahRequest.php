<?php

namespace App\Http\Requests\ProfilSekolah;

use Illuminate\Foundation\Http\FormRequest;

class IndexProfilSekolahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:100',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'search.max' => 'Kata kunci maksimal 100 karakter.',
    //     ];
    // }
}