<?php

namespace App\Http\Requests\Siswa;

use App\Models\Siswa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSiswaRequest extends FormRequest
{
    /**
     * Semua user yang sudah login boleh tambah siswa.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        return [
            'nisn'          => 'required|string|digits:10|unique:siswas,nisn',
            'nama_siswa'    => 'required|string|max:40',
            'jenis'         => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'required|digits:4|integer|min:1900|max:2099',
        ];
    }

    /**
     * Pesan error.
     */
    // public function messages(): array
    // {
    //     return [
    //         'nisn.required'         => 'NISN wajib diisi.',
    //         'nisn.numeric'          => 'NISN harus berupa angka.',
    //         'nisn.digits'           => 'NISN harus 10 digit.',
    //         'nisn.unique'           => 'NISN sudah terdaftar.',
    //         'nama_siswa.required'   => 'Nama siswa wajib diisi.',
    //         'nama_siswa.max'        => 'Nama siswa maksimal 40 karakter.',
    //         'jenis.required'        => 'Jenis kelamin wajib dipilih.',
    //         'jenis.in'              => 'Jenis kelamin tidak valid.',
    //         'tahun_masuk.required'  => 'Tahun masuk wajib diisi.',
    //         'tahun_masuk.digits'    => 'Tahun masuk harus 4 digit.',
    //         'tahun_masuk.integer'   => 'Tahun masuk harus berupa angka.',
    //         'tahun_masuk.min'       => 'Tahun masuk minimal 2000.',
    //         'tahun_masuk.max'       => 'Tahun masuk maksimal 2099.',
    //     ];
    // }
    // public function attributes(): array
    // {
    //     return [
    //         'nisn'        => 'NISN',
    //         'nama_siswa'  => 'Nama Siswa',
    //         'jenis'       => 'Jenis Kelamin',
    //         'tahun_masuk' => 'Tahun Masuk',
    //     ];
    // }
}