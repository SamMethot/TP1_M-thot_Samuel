<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => 'required|string|max:50',
            'password' => 'required|string|max:255',
            'email' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'first_name' => 'required|string|max:50'
        ];
    }
}
