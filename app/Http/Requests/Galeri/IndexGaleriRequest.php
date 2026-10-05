<?php

namespace App\Http\Requests\Galeri;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexGaleriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'   => 'nullable|string|max:100',
            'kategori' => ['nullable', 'string', Rule::in(['Foto', 'Video'])],
            'sort'     => ['nullable', 'string', Rule::in(['judul', 'kategori', 'created_at'])],
            'order'    => ['nullable', 'string', Rule::in(['asc', 'desc'])],
            'per_page' => 'nullable|integer|min:4|max:100',
            'page'     => 'nullable|integer|min:1',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'search.max'       => 'Kata kunci maksimal 100 karakter.',
    //         'kategori.in'      => 'Kategori tidak valid.',
    //         'sort.in'          => 'Kolom sort tidak valid.',
    //         'order.in'         => 'Urutan harus asc atau desc.',
    //         'per_page.integer' => 'Per halaman harus angka.',
    //         'per_page.min'     => 'Per halaman minimal 4.',
    //         'per_page.max'     => 'Per halaman maksimal 100.',
    //         'page.integer'     => 'Halaman harus angka.',
    //         'page.min'         => 'Halaman minimal 1.',
    //     ];
    // }
}