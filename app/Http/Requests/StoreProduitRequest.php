<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduitRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:produits,code|max:255', // Correction : 'code' au lieu de 'ref'
            'codeBar' => 'nullable|string|max:255',
            'prixRevient' => 'required|numeric|min:0', // Correction : 'prixRevient' au lieu de 'prixRrvient'
            'prixVente' => 'required|numeric|min:0',
            'tva' => 'required|numeric|min:0|max:100',
            'remise' => 'required|numeric|min:0|max:100',
        ];
    }
}
