<?php

namespace App\Http\Requests\Kerjasama;

use App\Models\Kerjasama;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Override;

class UpdateKerjasamaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $encryptedId = $this->route('kerjasama');
        $id = Crypt::decrypt($encryptedId);
        $kerjasama = Kerjasama::findOrFail($id);

        return [
            'nama_perusahaan' => 'required|string|max:40|unique:kerjasamas,nama_perusahaan,' . $kerjasama->id,
            'foto'            => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi.',
            'nama_perusahaan.unique'   => 'Nama perusahaan sudah digunakan.',
            'nama_perusahaan.max'      => 'Nama perusahaan maksimal 40 karakter.',
            'foto.mimes'               => 'Foto harus berformat png, jpg, jpeg, atau webp.',
            'foto.max'                 => 'Ukuran foto maksimal 2 MB.',
        ];
    }
}