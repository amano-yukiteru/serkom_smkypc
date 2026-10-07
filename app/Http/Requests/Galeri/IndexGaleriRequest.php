<?php

namespace App\Http\Requests\Galeri;

use Illuminate\Foundation\Http\FormRequest;

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
            'kategori' => 'nullable|string|in:Foto,Video',
            'sort'     => 'nullable|string|in:judul,kategori,created_at',
            'order'    => 'nullable|string|in:asc,desc',
            'per_page' => 'nullable|integer|min:4|max:100',
            'page'     => 'nullable|integer|min:1',
        ];
    }
}