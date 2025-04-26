<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Nama depan wajib diisi',
            'first_name.string' => 'Nama depan harus berupa teks',
            'first_name.max' => 'Nama depan tidak boleh lebih dari 255 karakter',
            'last_name.required' => 'Nama belakang wajib diisi',
            'last_name.string' => 'Nama belakang harus berupa teks',
            'last_name.max' => 'Nama belakang tidak boleh lebih dari 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.string' => 'Password harus berupa teks',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
