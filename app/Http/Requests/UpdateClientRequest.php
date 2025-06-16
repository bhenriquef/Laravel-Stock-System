<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'street' => 'required|string',
            'neighborhood' => 'required|string',
            'number' => 'required|string',
            'cep' => 'required|string',
            'country' => 'required|string',
        ];
    }
}
