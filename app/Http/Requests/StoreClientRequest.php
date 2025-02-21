<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'code' => 'required|string|max:255|unique:clients',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:clients',
            'phone' => 'required|string|max:255|unique:clients',
            'address' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
        ];
    }
}
