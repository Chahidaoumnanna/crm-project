<?php
//
//namespace App\Http\Controllers\Api;
//
//use App\Http\Requests\StorePaiementRequest;
//use App\Http\Requests\UpdatePaiementRequest;
//use App\Models\Paiement;
//use Illuminate\Http\Request;
//
//class PaiementController extends Controller
//{
//    /**
//     * Afficher la liste des paiements.
//     */
//    public function index()
//    {
//        $paiements = Paiement::all(); // Récupère uniquement les paiements sans relation
//        return response()->json($paiements);
//    }
//
//
//    /**
//     * Ajouter un nouveau paiement.
//     */
//    public function store(StorePaiementRequest $request)
//    {
//        $paiement = Paiement::create($request->validated());
//
//        return response()->json([
//            'message' => 'Paiement créé avec succès',
//            'paiement' => $paiement
//        ], 201);
//    }
//
//    /**
//     * Afficher un paiement spécifique.
//     */
//    public function show(Paiement $paiement)
//    {
//        return response()->json($paiement->load('bonLivraison')); // Charger la relation
//    }
//
//    /**
//     * Mettre à jour un paiement existant.
//     */
//    public function update(UpdatePaiementRequest $request, Paiement $paiement)
//    {
//        $paiement->update($request->validated());
//
//        return response()->json([
//            'message' => 'Paiement mis à jour avec succès',
//            'paiement' => $paiement
//        ]);
//    }
//
//    /**
//     * Supprimer un paiement.
//     */
//    public function destroy(Paiement $paiement)
//    {
//        $paiement->delete();
//
//        return response()->json([
//            'message' => 'Paiement supprimé avec succès'
//        ]);
//    }
//
//
////$validatedData = $request->all();
////        $bonLivraison = BonLivraison::create([
////            'idClient' => $validatedData['idClient'],
////            'ref' => '',
////            'docAt' => now(),
////            'totale' => 0,
////        ]);
//    public function apiCreatPaiment(Request $request)
//    {
//        $validatedData = $request->validate([
//            'mode' => 'required|string',
//            'montant' => 'required|numeric',
//            'echeanceAt' => 'nullable|date',
//        ]);
//
//        $paiement = Paiement::create($validatedData);
//
//        return response()->json([
//            'message' => 'Paiement créé avec succès !',
//            'paiement' => $paiement
//        ], 201);
//    }
//
//    public function apiPaiementes($idBonDeLivraison = null)
//    {
//        $paiements = Paiement::with('bonLivraison');
//
//        if ($idBonDeLivraison) {
//            $paiements = $paiements->where('idBonDeLivraison', $idBonDeLivraison);
//        }
//
//        return response()->json($paiements->get());
//    }
//
//
//
//}


namespace App\Http\Controllers\Api;

use App\Models\Paiement;
use App\Models\BonLivraison;
use Illuminate\Http\Request;
use App\Http\Requests\StorePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;

class PaiementController extends Controller
{
    /**
     * Afficher tous les paiements avec leur bon de livraison
     */
    public function index()
    {
        $paiements = Paiement::with('bonLivraison')->get();
        return response()->json($paiements);
    }

    /**
     * Créer un nouveau paiement
     */
    public function store(StorePaiementRequest $request)
    {
        $validated = $request->validated();

        $paiement = Paiement::create([
            'idBonDeLivraison' => $validated['idBonDeLivraison'],
            'echeanceAt' => $validated['echeanceAt'],
            'montant' => $validated['montant'],
            'mode' => $validated['mode']
        ]);

        return response()->json([
            'message' => 'Paiement créé avec succès',
            'paiement' => $paiement->load('bonLivraison')
        ], 201);
    }

    /**
     * Afficher un paiement spécifique
     */
    public function show(Paiement $paiement)
    {
        return response()->json($paiement->load('bonLivraison'));
    }

    /**
     * Mettre à jour un paiement
     */
    public function update(UpdatePaiementRequest $request, Paiement $paiement)
    {
        $paiement->update($request->validated());
        return response()->json([
            'message' => 'Paiement mis à jour',
            'paiement' => $paiement->load('bonLivraison')
        ]);
    }

    /**
     * Supprimer un paiement
     */
    public function destroy(Paiement $paiement)
    {
        $paiement->delete();
        return response()->json(['message' => 'Paiement supprimé']);
    }

    /**
     * API: Créer un paiement (version simplifiée)
     */
    public function apiCreatePaiement(Request $request)
    {
        $validatedData = $request->all();
        foreach ($validatedData['paiements'] as $paiement) {
            Paiement::create([
                'idBonDeLivraison' => $validatedData['idBonDeLivraison'],
                'echeanceAt' => $paiement['echeanceAt'],
                'montant' => $paiement['montant'],
                'mode' => $paiement['mode'],

            ]);

        }
        return response()->json(['message' => 'paiements ajoutés avec succès'], 201);

    }

    /**
     * API: Récupérer les paiements (avec filtre optionnel)
     */
    public function apiPaiements($idBonDeLivraison = null)
    {
        $query = Paiement::with('bonLivraison');

        if ($idBonDeLivraison) {
            $query->where('idBonDeLivraison', $idBonDeLivraison);
        }

        return response()->json($query->get());
    }
}
