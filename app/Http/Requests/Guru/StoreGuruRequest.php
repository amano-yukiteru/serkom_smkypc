<?php

namespace App\Http\Requests\Guru;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuruRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_guru' => 'required|string|max:60',
            'nip'       => 'required|string|digits:18|unique:gurus,nip',
            'mapel'     => 'required|string|max:40',
            'foto'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}