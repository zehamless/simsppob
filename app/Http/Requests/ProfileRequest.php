<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus berupa alamat email yang valid',
            'first_name.required' => 'Nama depan wajib diisi',
            'last_name.required' => 'Nama belakang wajib diisi',
            'first_name.string' => 'Nama depan harus berupa teks',
            'last_name.string' => 'Nama belakang harus berupa teks',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
