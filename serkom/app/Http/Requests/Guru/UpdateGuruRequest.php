<?php

namespace App\Http\Requests\Guru;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class UpdateGuruRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $guruId = $this->resolveGuruId();

        return [
            'nama_guru' => 'required|string|max:60',

            'nip' => [
                'required',
                'string',
                'digits:18',
                Rule::unique('gurus', 'nip')->ignore($guruId),
            ],

            'mapel' => 'required|string|max:40',

            // Foto opsional saat update — kalau tidak upload, pakai yang lama
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'nama_guru.required' => 'Nama guru wajib diisi.',
    //         'nama_guru.max'      => 'Nama guru maksimal 60 karakter.',

    //         'nip.required'       => 'NIP wajib diisi.',
    //         'nip.digits'         => 'NIP harus 18 digit angka.',
    //         'nip.unique'         => 'NIP sudah terdaftar.',

    //         'mapel.required'     => 'Mata pelajaran wajib diisi.',
    //         'mapel.max'          => 'Mata pelajaran maksimal 40 karakter.',

    //         'foto.image'         => 'Foto harus berupa gambar.',
    //         'foto.mimes'         => 'Foto harus berformat jpg, jpeg, png, atau webp.',
    //         'foto.max'           => 'Ukuran foto maksimal 2MB.',
    //     ];
    // }

    // public function attributes(): array
    // {
    //     return [
    //         'nama_guru' => 'Nama Guru',
    //         'nip'       => 'NIP',
    //         'mapel'     => 'Mata Pelajaran',
    //         'foto'      => 'Foto',
    //     ];
    // }

    private function resolveGuruId(): ?int
    {
        // Coba parameter encryptedId dulu
        if ($hash = $this->route('encryptedId')) {
            try {
                return (int) Crypt::decrypt($hash);
            } catch (\Throwable $e) {
                abort(404);
            }
        }

        // Fallback: parameter guru
        $param = $this->route('guru');

        // Kalau route model binding berhasil → object Guru
        if ($param instanceof \App\Models\Guru) {
            return $param->id;
        }

        // Kalau string hash → decode
        if (is_string($param) && $param !== '') {
            try {
                return (int) Crypt::decrypt($param);
            } catch (\Throwable $e) {
                abort(404);
            }
        }

        return null;
    }
}