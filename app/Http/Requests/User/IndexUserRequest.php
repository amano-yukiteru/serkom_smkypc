<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'   => 'nullable|string|max:100',
            'role'     => 'nullable|string|in:Admin,Oprator',
            'sort'     => 'nullable|string|in:name,username,role,created_at',
            'order'    => 'nullable|string|in:asc,desc',
            'per_page' => 'nullable|integer|min:5|max:100',
            'page'     => 'nullable|integer|min:1',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'search.max'       => 'Kata kunci maksimal 100 karakter.',
    //         'role.in'          => 'Role tidak valid.',
    //         'sort.in'          => 'Kolom sort tidak valid.',
    //         'order.in'         => 'Urutan harus asc atau desc.',
    //         'per_page.integer' => 'Per halaman harus angka.',
    //         'per_page.min'     => 'Per halaman minimal 5.',
    //         'per_page.max'     => 'Per halaman maksimal 100.',
    //         'page.integer'     => 'Halaman harus angka.',
    //         'page.min'         => 'Halaman minimal 1.',
    //     ];
    // }
}