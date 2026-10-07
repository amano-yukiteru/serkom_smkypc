<?php

namespace App\Http\Requests\Siswa;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexSiswaRequest extends FormRequest
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
            'search'      => 'nullable|string|max:50',
            'jenis'       => 'nullable|in:Laki-Laki,Perempuan',
            'tahun_masuk' => 'nullable|digits:4|integer',
            'page'        => 'nullable|integer|min:1',
        ];
    }
}