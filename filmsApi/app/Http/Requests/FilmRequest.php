<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
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
            'title' => 'required|string',
            'language_id' => 'required|integer',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer',
            'originale_language_id' => 'nullable|integer',
            'rental_duration' => 'nullable|integer',
            'rental_rate' => 'nullable|numeric',
            'length' => 'nullable|integer',
            'replacement_cost' => 'nullable|numeric',
            'rating' => 'nullable|string',
            'special_features' => 'nullable|string',
        ];
    }
}
