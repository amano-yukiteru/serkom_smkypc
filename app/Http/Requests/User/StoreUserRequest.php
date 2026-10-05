<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:30',
            'username' => 'required|string|max:30|unique:users,username',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:Admin,Oprator',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'username.required' => 'Username wajib diisi.',
    //         'username.max'      => 'Username maksimal 30 karakter.',
    //         'username.unique'   => 'Username sudah dipakai.',
    //         'password.required' => 'Password wajib diisi.',
    //         'password.min'      => 'Password minimal 6 karakter.',
    //         'role.required'     => 'Role wajib dipilih.',
    //         'role.in'           => 'Role tidak valid.',
    //     ];
    // }
}