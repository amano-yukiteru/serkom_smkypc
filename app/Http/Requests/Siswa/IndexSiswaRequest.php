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

    public function rules(): array
    {
        return [
            'search'      => 'nullable|string|max:50',
            'jenis'       => 'nullable|in:Laki-Laki,Perempuan',
            'tahun_masuk' => 'nullable|digits:4|integer',
            'page'        => 'nullable|integer|min:1',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'search.max'         => 'Kata kunci pencarian maksimal 50 karakter.',
    //         'jenis.in'           => 'Jenis kelamin tidak valid.',
    //         'tahun_masuk.digits' => 'Tahun masuk harus 4 digit.',
    //         'tahun_masuk.integer'=> 'Tahun masuk harus berupa angka.',
    //         'page.integer'       => 'Nomor halaman tidak valid.',
    //         'page.min'           => 'Nomor halaman minimal 1.',
    //     ];
    // }

    // public function attributes(): array
    // {
    //     return [
    //         'search'      => 'Kata Kunci',
    //         'jenis'       => 'Jenis Kelamin',
    //         'tahun_masuk' => 'Tahun Masuk',
    //         'page'        => 'Halaman',
    //     ];
    // }
}