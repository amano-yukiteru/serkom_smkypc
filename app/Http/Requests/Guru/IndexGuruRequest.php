<?php

namespace App\Http\Requests\Guru;

use Illuminate\Foundation\Http\FormRequest;

class IndexGuruRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'   => 'nullable|string|max:100',
            'sort'     => 'nullable|string|in:nama_guru,nip,mapel,created_at',
            'order'    => 'nullable|string|in:asc,desc',
            'per_page' => 'nullable|integer|min:5|max:100',
            'page'     => 'nullable|integer|min:1',
        ];
    }

    public function messages(){
        return [

        ];
    }
}