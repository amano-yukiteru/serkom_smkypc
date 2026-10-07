<?php

namespace App\Http\Requests\Ekstrakurikuler;

use App\Models\Ekstrakurikuler;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateEkstrakurikulerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $encryptedId = $this->route('ekstrakurikuler');
        $id = Crypt::decrypt($encryptedId);
        $eskul = Ekstrakurikuler::findOrFail($id);
        $id = $eskul->id;

        return [
            'nama_eskul' => "required|string|max:40|unique:ekstrakurikulers,nama_eskul," . $id,
            'pembina'    => 'required|string|max:40',
            'hari'       => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'deskripsi'  => 'required|string',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
        ];
    }
}