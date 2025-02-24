<?php

namespace App\Http\Controllers\Api;

use App\Models\BonLivraison;

class BonLivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bonlivraison.index');
        return response()->json(Produit::all());
    }
    /**
     * Enregistrer un nouveau bon de livraison
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'code' => 'required|string|unique:bon_livraisons,code',
            'IdClient' => 'required|integer|exists:clients,id',
            'docAt' => 'required|date',
            'totale' => 'required|numeric|min:0',
        ]);

        // Création du bon de livraison
        $bonLivraison = BonLivraison::create($request->all());

        // Retourner une réponse JSON
        return response()->json([
            'message' => 'Bon de livraison enregistré avec succès.',
            'bonLivraison' => $bonLivraison
        ], 201);
    }

    /**
     * Afficher un bon de livraison spécifique.
     */
    public function show(BonLivraison $bonLivraison)
    {
        return response()->json($bonLivraison);
    }

    /**
     * Mettre à jour un bon de livraison.
     */
    public function update(Request $request, BonLivraison $bonLivraison)
    {
        // Validation des données
        $request->validate([
            'code' => 'required|string|unique:bon_livraisons,code,' . $bonLivraison->id,
            'IdClient' => 'required|integer|exists:clients,id',
            'docAt' => 'required|date',
            'totale' => 'required|numeric|min:0',
        ]);

        // Mise à jour des données
        $bonLivraison->update($request->all());

        return response()->json([
            'message' => 'Bon de livraison mis à jour avec succès.',
            'bonLivraison' => $bonLivraison
        ], 200);
    }

    /**
     * Supprimer un bon de livraison.
     */
    public function destroy(BonLivraison $bonLivraison)
    {
        $bonLivraison->delete();
        return response()->json([
            'message' => 'Bon de livraison supprimé avec succès.'
        ],200);
        }
}
