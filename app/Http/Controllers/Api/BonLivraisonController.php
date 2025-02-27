<?php
//
//namespace App\Http\Controllers\Api;
//
//use App\Models\BonLivraison;
//use App\Models\BonLivraisonItem;
//use App\Models\Client;
//use Illuminate\Http\Request;
//
//class BonLivraisonController extends Controller
//{
//    public function index()
//    {
//        return view('bonlivraison.index');
//    }
//
//    public function store(Request $request)
//    {
//        $client = Client::where('name', $request->clientNom)->first();
//        if (!$client) {
//            return response()->json(['error' => 'Client non trouvé'], 404);
//        }
//
//        $bonLivraison = BonLivraison::create([
//            'idClient' => $client->id,
//            'ref' => 'BL-' . time(),
//            'docAt' => now(),
//            'totale' => 0,
//        ]);
//
//        $total = 0;
//        foreach ($request->products as $product) {
//            $total += $product['qte'] * $product['prixUnitaire'];
//
//            BonLivraisonItem::create([
//                'idProduit' => $product['idProduit'],
//                'idBonDeLivraison' => $bonLivraison->id,
//                'qte' => $product['qte'],
//                'prixUnitaire' => $product['prixUnitaire'],
//                'total' => $product['qte'] * $product['prixUnitaire'],
//            ]);
//        }
//
//        $bonLivraison->update(['totale' => $total]);
//
//        return response()->json(['message' => 'Bon de livraison créé avec succès', 'data' => $bonLivraison], 201);
//    }
//
//    public function show(BonLivraison $bonLivraison)
//    {
//        return response()->json($bonLivraison);
//    }
//
//    public function update(Request $request, BonLivraison $bonLivraison)
//    {
//        $request->validate([
//            'ref' => 'required|string|unique:bon_livraisons,ref,' . $bonLivraison->id,
//            'idClient' => 'required|integer|exists:clients,id',
//            'docAt' => 'required|date',
//            'totale' => 'required|numeric|min:0',
//        ]);
//
//        $bonLivraison->update($request->all());
//
//        return response()->json([
//            'message' => 'Bon de livraison mis à jour avec succès.',
//            'bonLivraison' => $bonLivraison
//        ], 200);
//    }
//
//    public function destroy(BonLivraison $bonLivraison)
//    {
//        $bonLivraison->delete();
//        return response()->json([
//            'message' => 'Bon de livraison supprimé avec succès.'
//        ], 200);
//    }
//
//    public function apiBonLivraison(Request $request)
//    {
//        $search = $request->get('search');
//
//        if ($search) {
//            $bonLivraisons = BonLivraison::where('ref', 'like', '%' . $search . '%')
//                ->orWhereHas('client', function ($query) use ($search) {
//                    $query->where('name', 'like', '%' . $search . '%');
//                })
//                ->get();
//        } else {
//            $bonLivraisons = BonLivraison::all();
//        }
//        return response()->json($bonLivraisons);
//    }
//}


namespace App\Http\Controllers\Api;

use App\Models\BonLivraison;
use App\Models\BonLivraisonItem;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BonLivraisonController extends Controller
{
    public function index()
    {
        return view('bonlivraison.index');
    }

    public function store(Request $request)
    {
        $client = Client::where('name', $request->clientNom)->first();
        if (!$client) {
            return response()->json(['error' => 'Client non trouvé'], 404);
        }

        $bonLivraison = BonLivraison::create([
            'idClient' => $client->id,
            'ref' => '',
            'docAt' => now(),
            'totale' => 0,
        ]);

        $total = 0;
        foreach ($request->products as $product) {
            $total += $product['qte'] * $product['prixUnitaire'];

            BonLivraisonItem::create([
                'idProduit' => $product['idProduit'],
                'idBonDeLivraison' => $bonLivraison->id,
                'qte' => $product['qte'],
                'prixUnitaire' => $product['prixUnitaire'],
                'total' => $product['qte'] * $product['prixUnitaire'],
            ]);
        }

        $bonLivraison->update(['totale' => $total]);

        return response()->json(['message' => 'Bon de livraison créé avec succès', 'data' => $bonLivraison], 201);
    }

    public function show(BonLivraison $bonLivraison)
    {
        return response()->json($bonLivraison);
    }

    public function update(Request $request, BonLivraison $bonLivraison)
    {
        $request->validate([
            'ref' => 'required|string,',
            'idClient' => 'required|integer',
            'docAt' => 'required|date',
            'totale' => 'required|numeric|min:0',
        ]);

        $bonLivraison->update($request->all());

        return response()->json([
            'message' => 'Bon de livraison mis à jour avec succès.',
            'bonLivraison' => $bonLivraison
        ], 200);
    }

    public function destroy(BonLivraison $bonLivraison)
    {
        $bonLivraison->delete();
        return response()->json([
            'message' => 'Bon de livraison supprimé avec succès.'
        ], 200);
    }

    public function apiBonLivraison(Request $request)
    {
        $search = $request->get('search');

        if ($search) {
            $bonLivraisons = BonLivraison::where('ref', 'like', '%' . $search . '%')
                ->orWhereHas('client', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->get();
        } else {
            $bonLivraisons = BonLivraison::all();
        }
        return response()->json($bonLivraisons);
    }

    public function apiCreateBonLivraison(Request $request)
    {
//        $validatedData = $request->validate([
//            'client_id' => 'required|exists:clients,id',
//        ]);
        $validatedData = $request->all();
        $bonLivraison = BonLivraison::create([
            'idClient' => $validatedData['idClient'],
            'ref' => '',
            'docAt' => now(),
            'totale' => 0,
        ]);

//        $total = 0;
//        foreach ($validatedData['products'] as $product) {
//            $total += $product['qte'] * $product['prixUnitaire'];
//
//            BonLivraisonItem::create([
//                'idProduit' => $product['idProduit'],
//                'idBonDeLivraison' => $bonLivraison->id,
//                'qte' => $product['qte'],
//                'prixUnitaire' => $product['prixUnitaire'],
//                'total' => $product['qte'] * $product['prixUnitaire'],
//            ]);
//        }
//
//        $bonLivraison->update(['totale' => $total]);

        return response()->json(['message' => 'Bon de livraison créé avec succès', 'data' => $bonLivraison], 201);
    }
}
