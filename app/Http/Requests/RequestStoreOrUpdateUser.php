<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestStoreOrUpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255|',
            'email' => 'required|email|' . Rule::unique('users', 'email')->ignore($this->id),
            'role' => 'required|in:admin,petugas',
            'password' => 'nullable|min:6',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'role.required' => 'Kolom role harus diisi.',
            'role.in' => 'Role tidak valid.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.mimes' => 'Format gambar tidak valid.',
            'avatar.max' => 'Gambar tidak boleh lebih dari 2MB.',
            'confirmation_password.required' => 'Kolom konfirmasi password harus diisi.',
            'confirmation_password.same' => 'Konfirmasi password tidak sama.',
        ];
    }
}
