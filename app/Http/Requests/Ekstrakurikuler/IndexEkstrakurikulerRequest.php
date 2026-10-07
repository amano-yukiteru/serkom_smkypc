<?php

namespace App\Http\Requests\Ekstrakurikuler;

use Illuminate\Foundation\Http\FormRequest;

class IndexEkstrakurikulerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'   => 'nullable|string|max:100',
            'sort'     => 'nullable|string|in:nama_eskul,pembina,jadwal_latihan,created_at',
            'order'    => 'nullable|string|in:asc,desc',
            'per_page' => 'nullable|integer|min:5|max:100',
            'page'     => 'nullable|integer|min:1',
        ];
    }
}