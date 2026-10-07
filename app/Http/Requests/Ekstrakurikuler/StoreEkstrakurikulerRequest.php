<?php

namespace App\Http\Requests\Ekstrakurikuler;

use Illuminate\Foundation\Http\FormRequest;

class StoreEkstrakurikulerRequest extends FormRequest
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
        return [
            'nama_eskul'            => 'required|string|max:40|unique:ektrakurikulers,nama_eskul',
            'guru'                  => 'required|string|exists:gurus.nama_gurus',
            'jadwal_latihan'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'deskripsi'             => 'required|string',
            'foto'                  => 'required|image|mimes:jpg,jpeg,png,webp|max:10000',
        ];
    }
}