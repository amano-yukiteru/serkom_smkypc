<?php

namespace App\Http\Requests\Guru;

use App\Models\Guru;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateGuruRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $encryptedId = $this->route('guru');
        $id = Crypt::decrypt($encryptedId);
        $guru = Guru::findOrFail($id);
        $id = $guru->id;

        return [
            'nama_guru' => 'required|string|max:60',
            'nip'       => "required|string|digits:18|unique:gurus,nip," . $id,
            'mapel'     => 'required|string|max:40',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}