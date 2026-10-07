<?php

namespace App\Http\Requests\Siswa;

use App\Models\Siswa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSiswaRequest extends FormRequest
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
            'nisn'          => 'required|string|digits:10|unique:siswas,nisn',
            'nama_siswa'    => 'required|string|max:40',
            'jenis'         => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'required|digits:4|integer|min:1900|max:2099',
        ];
    }
}