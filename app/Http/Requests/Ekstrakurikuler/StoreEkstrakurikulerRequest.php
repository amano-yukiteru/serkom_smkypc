<?php

namespace App\Http\Requests\Ekstrakurikuler;

use Illuminate\Foundation\Http\FormRequest;

class StoreEkstrakurikulerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_eskul'            => 'required|string|max:40|unique:ektrakurikulers,nama_eskul',
            'pembina'               => 'required|string|max:40',
            'jadwal_latihan'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'deskripsi'             => 'required|string',
            'foto'                  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    //    public function messages(): array
    //     {
    //         return [
    //             'nama_eskul.required'     => 'Nama ekstrakurikuler wajib diisi.',
    //             'nama_eskul.max'          => 'Nama ekstrakurikuler maksimal 40 karakter.',
    //             'nama_eskul.unique'       => 'Nama ekstrakurikuler sudah terdaftar.',

    //             'pembina.required'        => 'Pembina wajib diisi.',
    //             'pembina.max'             => 'Pembina maksimal 40 karakter.',

    //             'jadwal_latihan.required' => 'Jadwal latihan wajib diisi.',
    //             // Ganti bagian max menjadi .in
    //             'jadwal_latihan.in'       => 'Jadwal latihan harus salah satu dari: Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, Minggu.', 

    //             'deskripsi.required'      => 'Deskripsi wajib diisi.',

    //             'foto.required'           => 'Foto wajib diunggah.',
    //             'foto.image'              => 'Foto harus berupa gambar.',
    //             'foto.mimes'              => 'Foto harus berformat jpg, jpeg, png, atau webp.',
    //             'foto.max'                => 'Ukuran foto maksimal 2MB.',
    //         ];
    //     }

    // public function attributes(): array
    // {
    //     return [
    //         'nama_eskul'     => 'Nama Ekstrakurikuler',
    //         'pembina'        => 'Pembina',
    //         'jadwal_latihan' => 'Jadwal Latihan',
    //         'deskripsi'      => 'Deskripsi',
    //         'foto'           => 'Foto',
    //     ];
    // }
}