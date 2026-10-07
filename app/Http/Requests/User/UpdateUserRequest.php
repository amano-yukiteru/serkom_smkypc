<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $encryptedId = $this->route('user');
        $id = Crypt::decrypt($encryptedId);
        $user = User::findOrFail($id);
        $id = $user->id;

        return [
            'name'     => 'required|string|max:30',
            'username' => 'required|string|max:30|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8',
            'role'     => 'required|in:Admin,Oprator',
        ];
    }
}