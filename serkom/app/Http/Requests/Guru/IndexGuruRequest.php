<?php

namespace App\Http\Requests\Guru;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexGuruRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Semua parameter opsional — index tidak wajib isi apa-apa.
     */
    public function rules(): array
    {
        return [
            'search'   => 'nullable|string|max:100',
            'sort'     => ['nullable', 'string', Rule::in(['nama_guru', 'nip', 'mapel', 'created_at'])],
            'order'    => ['nullable', 'string', Rule::in(['asc', 'desc'])],
            'per_page' => 'nullable|integer|min:5|max:100',
            'page'     => 'nullable|integer|min:1',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'search.max'      => 'Kata kunci maksimal 100 karakter.',
    //         'sort.in'         => 'Kolom sort tidak valid.',
    //         'order.in'        => 'Urutan harus asc atau desc.',
    //         'per_page.integer'=> 'Per halaman harus angka.',
    //         'per_page.min'    => 'Per halaman minimal 5.',
    //         'per_page.max'    => 'Per halaman maksimal 100.',
    //         'page.integer'    => 'Halaman harus angka.',
    //         'page.min'        => 'Halaman minimal 1.',
    //     ];
    // }

    // /**
    //  * Nilai default kalau parameter tidak diisi.
    //  */
    // public function defaults(): array
    // {
    //     return [
    //         'sort'     => 'created_at',
    //         'order'    => 'desc',
    //         'per_page' => 10,
    //     ];
    // }
}