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
            'nama_eskul' => 'required|string|max:40|unique:ekstrakurikulers,nama_eskul',
            'pembina'    => 'required|string|max:40',
            'hari'       => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'deskripsi'  => 'required|string',
            'foto'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}