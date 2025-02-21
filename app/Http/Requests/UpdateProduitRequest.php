<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProduitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autoriser la mise à jour
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
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('produits', 'code')->ignore($this->produit), // Ignorer l'unicité pour le produit actuel
            ],
            'codeBar' => 'nullable|string|max:255|unique:produits,codeBar,' . $this->produit,
            'prixRevient' => 'required|numeric|min:0',
            'prixVente' => 'required|numeric|min:0',
            'tva' => 'required|numeric|min:0|max:100',
            'remise' => 'required|numeric|min:0|max:100',
        ];
    }
}
