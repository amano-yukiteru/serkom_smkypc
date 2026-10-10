<?php

namespace App\Http\Requests\Kerjasama;

use Illuminate\Foundation\Http\FormRequest;

class IndexKerjasamaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'   => 'nullable|string|max:100',
            // 'kategori' => 'nullable|string|max:50',
            // 'sort'     => 'nullable|in:created_at,nama_perusahaan,kategori',
            'order'    => 'nullable|in:asc,desc',
            'per_page' => 'nullable|integer|in:9,18,27,36',
        ];
    }

    public function messages(): array
    {
        return [
            // 'sort.in'     => 'Kolom pengurutan tidak valid.',
            // 'order.in'    => 'Arah pengurutan tidak valid.',
            'per_page.in' => 'Jumlah per halaman tidak valid.',
        ];
    }
}