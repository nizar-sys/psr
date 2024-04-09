<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestStoreOrUpdateMasyarakat extends FormRequest
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
        return [
            'nik' => 'required|numeric|',
            'name' => 'required|max:255|',
            'email' => 'required|email|',
            'password' => 'nullable|min:6',
            'no_telp' => 'required|numeric|',
            'alamat' => 'required|max:255|',
        ];
    }

    public function messages()
    {
        return [
            'nik.required' => 'Kolom NIK harus diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus berjumlah 16 digit.',
            'nik.unique' => 'NIK sudah digunakan.',
            'name.required' => 'Kolom nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'no_telp.required' => 'Kolom nomor telepon harus diisi.',
            'no_telp.numeric' => 'Nomor telepon harus berupa angka.',
            'no_telp.digits_between' => 'Nomor telepon harus berjumlah 10-13 digit.',
            'no_telp.unique' => 'Nomor telepon sudah digunakan.',
            'alamat.required' => 'Kolom alamat harus diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'confirmation_password.required' => 'Kolom konfirmasi password harus diisi.',
            'confirmation_password.same' => 'Konfirmasi password tidak sama.',
        ];
    }
}
