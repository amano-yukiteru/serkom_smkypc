<?php

namespace App\Http\Requests\Siswa;

use App\Models\Siswa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

        /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $encryptedId = $this->route('siswa');
        $id = Crypt::decrypt($encryptedId);
        $siswa = Siswa::findOrFail($id);
        $id = $siswa->id;
        
        return [
            'nisn'        => 'required|digits:10|unique:siswas,nisn,' . $id,
            'nama_siswa'  => 'required|string|max:40',
            'jenis'       => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk' => 'required|digits:4|integer|min:2000|max:' . date('Y'),
        ];
    }
}