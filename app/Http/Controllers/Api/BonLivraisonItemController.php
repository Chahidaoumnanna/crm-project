<?php
//namespace App\Http\Controllers\Api;
//
//use App\Models\BonLivraisonItem;
//use Illuminate\Http\Request;
//
//class BonLivraisonItemController extends Controller
//{
//    public function index()
//    {
//        return response()->json(BonLivraisonItem::all());
//    }
//    public function store(Request $request)
//    {
//        $request->validate([
//            'idBonDeLivraison' => 'required|exists:bon_livraisons,id',
//            'products' => 'required|array',
//            'products.*.idProduit' => 'required|exists:produits,id',
//            'products.*.qte' => 'required|integer|min:1',
//            'products.*.prixUnitaire' => 'required|numeric|min:0',
//        ]);
//
//        foreach ($request->products as $product) {
//            BonLivraisonItem::create([
//                'idBonDeLivraison' => $request->idBonDeLivraison, // S'assurer qu'il est bien utilisé
//                'idProduit' => $product['idProduit'],
//                'qte' => $product['qte'],
//                'prixUnitaire' => $product['prixUnitaire'],
//                'total' => $product['qte'] * $product['prixUnitaire'],
//            ]);
//        }
//
//        return response()->json(['message' => 'Produits ajoutés avec succès'], 201);
//    }
//
//
//
//    public function show(BonLivraisonItem $bonLivraisonItem)
//    {
//        return response()->json($bonLivraisonItem);
//    }
//
//    public function update(Request $request, BonLivraisonItem $bonLivraisonItem)
//    {
//        $request->validate([
//            'idProduit' => 'required|integer|exists:produits,id',
//            'idBonDeLivraison' => 'required|integer|exists:bon_livraisons,id',
//            'qte' => 'required|integer|min:1',
//            'prixUnitaire' => 'required|numeric|min:0',
//        ]);
//
//        $bonLivraisonItem->update([
//            ...$request->all(),
//            'total' => $request->qte * $request->prixUnitaire // <-- Calcul
//        ]);
//        return response()->json([
//            'message' => 'Item mis à jour avec succès.',
//            'bonLivraisonItem' => $bonLivraisonItem
//        ], 200);
//    }
//
//    public function destroy(BonLivraisonItem $bonLivraisonItem)
//    {
//        $bonLivraisonItem->delete();
//        return response()->json([
//            'message' => 'Item supprimé avec succès.'
//        ], 200);
//    }
//    public function apiBonLivraisonItems(Request $request)
//    {
//        $search = $request->get('search');
//
//        // Vérifier si une recherche est effectuée
//        if ($search) {
//            $BonLivraisonItem = BonLivraisonItem::where('ref', 'like', '%' . $search . '%')
//                ->orWhereHas('client', function ($query) use ($search) {
//                    $query->where('name', 'like', '%' . $search . '%');
//                })
//                ->get();
//        } else {
//            $BonLivraisonItem = BonLivraisonItem::all();
//        }
//
//        return response()->json($BonLivraisonItem);
//    }
//}


namespace App\Http\Controllers\Api;

use App\Models\BonLivraison;
use App\Models\BonLivraisonItem;
use App\Models\Produit; // Assurez-vous que vous avez ce modèle pour gérer les produits
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BonLivraisonItemController extends Controller
{
    // Récupérer tous les items de bon de livraison
    public function index()
    {
        return response()->json(BonLivraisonItem::all());
    }

    // Ajouter des items à un bon de livraison
    public function store(Request $request)
    {
        $request->validate([
            'idBonDeLivraison' => 'required|exists:bon_livraisons,id', // Validation pour le bon de livraison
            'products' => 'required|array', // Validation pour les produits
            'products.*.idProduit' => 'required|exists:produits,id', // Validation pour chaque produit
            'products.*.qte' => 'required|integer|min:1', // Validation de la quantité
            'products.*.prixUnitaire' => 'required|numeric|min:0', // Validation du prix unitaire
        ]);

        foreach ($request->products as $product) {
            BonLivraisonItem::create([
                'idBonDeLivraison' => $request->idBonDeLivraison,
                'idProduit' => $product['idProduit'],
                'qte' => $product['qte'],
                'prixUnitaire' => $product['prixUnitaire'],
                'total' => $product['qte'] * $product['prixUnitaire'], // Calcul du total
            ]);
        }

        return response()->json(['message' => 'Produits ajoutés avec succès'], 201);
    }

    // Afficher un item spécifique d'un bon de livraison
    public function show(BonLivraisonItem $bonLivraisonItem)
    {
        return response()->json($bonLivraisonItem);
    }

    // Mettre à jour un item dans un bon de livraison
    public function update(Request $request, BonLivraisonItem $bonLivraisonItem)
    {
        $request->validate([
            'idProduit' => 'required|integer|exists:produits,id',
            'idBonDeLivraison' => 'required|integer|exists:bon_livraisons,id',
            'qte' => 'required|integer|min:1',
            'prixUnitaire' => 'required|numeric|min:0',
        ]);

        // Mise à jour de l'item avec le calcul du total
        $bonLivraisonItem->update([
            ...$request->all(),
            'total' => $request->qte * $request->prixUnitaire // Calcul du total
        ]);

        return response()->json([
            'message' => 'Item mis à jour avec succès.',
            'bonLivraisonItem' => $bonLivraisonItem
        ], 200);
    }

    // Supprimer un item d'un bon de livraison
    public function destroy(BonLivraisonItem $bonLivraisonItem)
    {
        $bonLivraisonItem->delete();
        return response()->json([
            'message' => 'Item supprimé avec succès.'
        ], 200);
    }

    // Route API pour chercher des items de bon de livraison
    public function apiBonLivraisonItems(Request $request)
    {
        $search = $request->get('search');

        // Vérifier si une recherche est effectuée
        if ($search) {
            $bonLivraisonItems = BonLivraisonItem::whereHas('produit', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
                ->orWhere('idBonDeLivraison', 'like', '%' . $search . '%')
                ->get();
        } else {
            $bonLivraisonItems = BonLivraisonItem::all();
        }

        return response()->json($bonLivraisonItems);
    }

    // Fonction pour créer un nouvel item dans un bon de livraison via une route POST
    public function apiCreateBonLivraisonItem(Request $request)
    {
        $validatedData = $request->all();

        foreach ($validatedData['products'] as $product) {
            BonLivraisonItem::create([
                'idBonDeLivraison' => $validatedData['idBonDeLivraison'],
                'idProduit' => $product['idProduit'],
                'qte' => $product['qte'],
                'prixUnitaire' => $product['prixUnitaire'],
                'total' => $product['qte'] * $product['prixUnitaire'],
            ]);
        }
//
        return response()->json(['message' => 'Items ajoutés avec succès'], 201);
    }
}
