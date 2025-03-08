<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|numeric',
            'nim' => 'required|string',
            'nama' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'no_handphone' => 'required|numeric',
            'alamat' => 'required|string',
        ];
    }
}
