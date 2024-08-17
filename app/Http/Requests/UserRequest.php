<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'telephone' => ['required', 'unique:users,id', 'numeric', 'digits:10'],
            'id_regime' => ['required'],
            'email' => ['required', 'unique:users,id', 'email'],
            'password' => ['required', 'min:8']
        ];
    }
}
