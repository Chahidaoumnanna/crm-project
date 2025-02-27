<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Afficher la liste des paiements.
     */
    public function index()
    {
        $paiements = Paiement::with('bonLivraison')->get(); // Charger la relation bonLivraison
        return response()->json($paiements);
    }

    /**
     * Ajouter un nouveau paiement.
     */
    public function store(StorePaiementRequest $request)
    {
        $paiement = Paiement::create($request->validated());

        return response()->json([
            'message' => 'Paiement créé avec succès',
            'paiement' => $paiement
        ], 201);
    }

    /**
     * Afficher un paiement spécifique.
     */
    public function show(Paiement $paiement)
    {
        return response()->json($paiement->load('bonLivraison')); // Charger la relation
    }

    /**
     * Mettre à jour un paiement existant.
     */
    public function update(UpdatePaiementRequest $request, Paiement $paiement)
    {
        $paiement->update($request->validated());

        return response()->json([
            'message' => 'Paiement mis à jour avec succès',
            'paiement' => $paiement
        ]);
    }

    /**
     * Supprimer un paiement.
     */
    public function destroy(Paiement $paiement)
    {
        $paiement->delete();

        return response()->json([
            'message' => 'Paiement supprimé avec succès'
        ]);
    }

    /**
     * Récupérer les paiements avec un filtre optionnel sur IdBonLivraison.
     */
    public function apiPaiementes($idBonLivraison = null)
    {
        $paiements = Paiement::with('bonLivraison');

        if ($idBonLivraison) {
            $paiements = $paiements->where('IdBonLivraison', $idBonLivraison);
        }

        return response()->json($paiements->get());
    }

    /**
     * Ajouter un paiement via API.
     */
    public function apiCreatePaiement(StorePaiementRequest $request)
    {
        $paiement = Paiement::create($request->validated());

        return response()->json([
            'message' => 'Paiement créé avec succès !',
            'paiement' => $paiement
        ], 201);
    }
} //
