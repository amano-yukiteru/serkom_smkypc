<?php

namespace App\Http\Requests\Ekstrakurikuler;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class UpdateEkstrakurikulerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $eskulId = $this->resolveEskulId();

        return [
            'nama_eskul' => [
                'required',
                'string',
                'max:40',
                Rule::unique('ektrakurikulers', 'nama_eskul')->ignore($eskulId),
            ],
            'pembina'   => 'required|string|max:40',
            'hari'      => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    private function resolveEskulId(): ?int
    {
        $param = $this->route('encryptedId') ?? $this->route('ekstrakurikuler');

        if ($param instanceof \App\Models\Ekstrakurikuler) {
            return $param->id;
        }

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