<?php

namespace App\Http\Requests\Jurusan;

use App\Models\Jurusan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateJurusanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
{
        $encryptedId = $this->route('jurusan');
        $id = Crypt::decrypt($encryptedId);
        $jurusan = Jurusan::findOrFail($id);
        $id = $jurusan->id;

        return [
            'nama'      => "required|string|max:100|unique:jurusans,nama," . $id,
            'singkatan' => "required|string|max:10|unique:jurusans,singkatan," . $id,
            'deskripsi' => "required|string",
            'logo'      => "required|image|mimes:jpg,jpeg,png,webp|max:2048",
        ];
    }
}
