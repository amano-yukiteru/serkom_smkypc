<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->resolveUserId();

        return [
            'name'     => 'required|string|max:30',
            'username' => 'required|string|max:30|unique:users,username,' . $userId,
            'password' => 'nullable|string|min:8',
            'role'     => 'required|in:Admin,Oprator',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'name.required'     => 'Nama wajib diisi.',
    //         'name.max'          => 'Nama maksimal 30 karakter.',
    //         'username.required' => 'Username wajib diisi.',
    //         'username.max'      => 'Username maksimal 30 karakter.',
    //         'username.unique'   => 'Username sudah dipakai.',
    //         'password.min'      => 'Password minimal 8 karakter.',
    //         'role.required'     => 'Role wajib dipilih.',
    //         'role.in'           => 'Role tidak valid.',
    //     ];
    // }

    private function resolveUserId(): ?int
    {
        $param = $this->route('encryptedId') ?? $this->route('user');

        if ($param instanceof User) {
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