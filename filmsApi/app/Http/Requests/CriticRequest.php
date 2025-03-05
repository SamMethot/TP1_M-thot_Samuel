<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriticRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|numeric|min:1|max:11',
            'film_id' => 'required|numeric|min:1|max:11',
            'score' => 'required|numeric|decimal:3,1', // Documentation : https://laravel.com/docs/11.x/validation#rule-decimal
            'comment' => 'string',
            'created_at' => 'required|date',
            'updated_at' => 'requires|date'
        ];
    }
}
