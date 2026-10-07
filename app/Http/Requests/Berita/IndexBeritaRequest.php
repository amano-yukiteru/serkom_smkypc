<?php

namespace App\Http\Requests\Berita;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexBeritaRequest extends FormRequest
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
    public function rules()
    {
        return [
            'search'    => 'nullable|string|max:100',
            'sort'      => 'nullable|string|in:judul,tanggal,created_at',
            'order'     => 'nullable|string|in:asc,desc',
            'per_page'  => 'nullable|integer|min:5|max:100',
            'page'      => 'nullable|integer|min:1',
            'bulan'     => 'nullable|integer|min:1|max:12',
            'tahun'     => 'nullable|integer|min:2000|max:'.(date('Y') + 1),
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'search.max'        => 'Kata kunci maksimal 100 karakter.',
    //         'sort.in'           => 'Kolom sort tidak valid.',
    //         'order.in'          => 'Urutan harus asc atau desc.',
    //         'per_page.integer'  => 'Per halaman harus angka.',
    //         'per_page.min'      => 'Per halaman minimal 5.',
    //         'per_page.max'      => 'Per halaman maksimal 100.',
    //         'page.integer'      => 'Halaman harus angka.',
    //         'page.min'          => 'Halaman minimal 1.',

    //     ];
    // }
}
