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
//
//    public function store(Request $request)
//    {
//        $request->validate([
//            'idProduit' => 'required|integer|exists:produits,id',
//            'idBonDeLivraison' => 'required|integer|exists:bon_livraisons,id',
//            'qte' => 'required|integer|min:1',
//            'prixUnitaire' => 'required|numeric|min:0',
//        ]);
//
//        $bonLivraisonItem = BonLivraisonItem::create($request->all());
//
//        return response()->json([
//            'message' => 'Item ajouté avec succès.',
//            'bonLivraisonItem' => $bonLivraisonItem
//        ], 201);
//    }
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
//        $bonLivraisonItem->update($request->all());
//
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
//}


namespace App\Http\Controllers\Api;

use App\Models\BonLivraisonItem;
use Illuminate\Http\Request;

class BonLivraisonItemController extends Controller
{
    public function index()
    {
        return response()->json(BonLivraisonItem::all());
    }
    public function store(Request $request)
    {
        $request->validate([
            'idBonDeLivraison' => 'required|exists:bon_livraisons,id',
            'products' => 'required|array',
            'products.*.idProduit' => 'required|exists:produits,id',
            'products.*.qte' => 'required|integer|min:1',
            'products.*.prixUnitaire' => 'required|numeric|min:0',
        ]);
        foreach ($request->products as $product) {
            BonLivraisonItem::create([
                'idBonDeLivraison' => $request->idBonDeLivraison,
                'idProduit' => $product['idProduit'],
                'qte' => $product['qte'],
                'prixUnitaire' => $product['prixUnitaire'],
            ]);
        }

        return response()->json(['message' => 'Produits ajoutés avec succès'], 201);
    }


    public function show(BonLivraisonItem $bonLivraisonItem)
    {
        return response()->json($bonLivraisonItem);
    }

    public function update(Request $request, BonLivraisonItem $bonLivraisonItem)
    {
        $request->validate([
            'idProduit' => 'required|integer|exists:produits,id',
            'idBonDeLivraison' => 'required|integer|exists:bon_livraisons,id',
            'qte' => 'required|integer|min:1',
            'prixUnitaire' => 'required|numeric|min:0',
        ]);

        $bonLivraisonItem->update($request->all());

        return response()->json([
            'message' => 'Item mis à jour avec succès.',
            'bonLivraisonItem' => $bonLivraisonItem
        ], 200);
    }

    public function destroy(BonLivraisonItem $bonLivraisonItem)
    {
        $bonLivraisonItem->delete();
        return response()->json([
            'message' => 'Item supprimé avec succès.'
        ], 200);
    }
    public function apiBonLivraisonItems(Request $request)
    {
        $search = $request->get('search');

        // Vérifier si une recherche est effectuée
        if ($search) {
            $BonLivraisonItem = BonLivraisonItem::where('ref', 'like', '%' . $search . '%')
                ->orWhereHas('client', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->get();
        } else {
            $BonLivraisonItem = BonLivraisonItem::all();
        }

        return response()->json($BonLivraisonItem);
    }
}
