<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaiementRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     */
    public function authorize(): bool
    {
        return true; // Autorisez l'accès à tous les utilisateurs (ajustez selon vos besoins).
    }

    /**
     * Obtenir les règles de validation qui s'appliquent à la requête.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'IdBonLivraison' => 'required|exists:bon_livraisons,id', // Assurez-vous que la clé étrangère existe dans la table 'bon_livraisons'
            'echeanceAt' => 'required|date|after_or_equal:today', // Date d'échéance requise, doit être une date future ou égale à aujourd'hui
            'montant' => 'required|numeric|min:0.01', // Montant requis, doit être un nombre positif
            'mode' => 'required|string|max:255', // Mode de paiement requis, doit être une chaîne de caractères
        ];
    }

    /**
     * Obtenir les messages d'erreur personnalisés pour la validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'IdBonLivraison.required' => 'Le champ IdBonLivraison est requis.',
            'IdBonLivraison.exists' => 'Le bon de livraison sélectionné n\'existe pas.',
            'echeanceAt.required' => 'La date d\'échéance est requise.',
            'echeanceAt.date' => 'La date d\'échéance doit être une date valide.',
            'echeanceAt.after_or_equal' => 'La date d\'échéance doit être aujourd\'hui ou dans le futur.',
            'montant.required' => 'Le montant est requis.',
            'montant.numeric' => 'Le montant doit être un nombre.',
            'montant.min' => 'Le montant doit être supérieur à zéro.',
            'mode.required' => 'Le mode de paiement est requis.',
            'mode.string' => 'Le mode de paiement doit être une chaîne de caractères.',
            'mode.max' => 'Le mode de paiement ne peut pas dépasser 255 caractères.',
            ];
        }
}
