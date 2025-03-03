<?php
//namespace App\Http\Controllers\Api;
//
//use App\Models\BonLivraison;
//use App\Models\BonLivraisonItem;
//use App\Models\Client;
//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
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
//            'ref' => '',
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
//            'ref' => 'required|string,',
//            'idClient' => 'required|integer',
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
//
//    public function apiCreateBonLivraison(Request $request)
//    {
////        $validatedData = $request->validate([
////            'client_id' => 'required|exists:clients,id',
////        ]);
//        $validatedData = $request->all();
//        $bonLivraison = BonLivraison::create([
//            'idClient' => $validatedData['idClient'],
//            'ref' => '',
//            'docAt' => now(),
//            'totale' => 0,
//        ]);
//
////        $total = 0;
////        foreach ($validatedData['products'] as $product) {
////            $total += $product['qte'] * $product['prixUnitaire'];
////
////            BonLivraisonItem::create([
////                'idProduit' => $product['idProduit'],
////                'idBonDeLivraison' => $bonLivraison->id,
////                'qte' => $product['qte'],
////                'prixUnitaire' => $product['prixUnitaire'],
////                'total' => $product['qte'] * $product['prixUnitaire'],
////            ]);
////        }
////
////        $bonLivraison->update(['totale' => $total]);
//        //
//
//        return response()->json(['message' => 'Bon de livraison créé avec succès', 'data' => $bonLivraison], 201);
//    }
//}


namespace App\Http\Controllers\Api;

use App\Models\BonLivraison;
use App\Models\Paiement;
use App\Models\BonLivraisonItem;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BonLivraisonController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $bonlivraison = BonLivraison::query()
            ->when($search, function ($query, $search) {
                return $query->where('id', 'like', '%' . $search . '%');
            })
            ->paginate(30); // Ajoutez la pagination si nécessaire

        // Vérifie si la requête attend une réponse JSON
        if ($request->wantsJson()) {
            return response()->json($bonlivraison);
        }

        return view('bonlivraison.index', compact('bonlivraison')); // Ajout du passage de la variable à la vue
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
            foreach ($request->paiements as $paiement) {
                Paiement::create([
                    'idBonDeLivraison' => $bonLivraison->id,
                    'echeanceAt' => $paiement['echeanceAt'],
                    'montant' => $paiement['montant'],
                    'mode' => $paiement['mode']
                ]);
            }
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
        // Supprimer d'abord les éléments liés
        BonLivraisonItem::where('idBonDeLivraison', $bonLivraison->id)->delete();

        // Maintenant, supprimer le bon de livraison
        $bonLivraison->delete();

        return response()->json(['message' => 'Bon de livraison supprimé avec succès.']);
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


        //

        return response()->json(['message' => 'Bon de livraison créé avec succès', 'data' => $bonLivraison], 201);
    }
    public function create()
    {
        return view('bonlivraison.create'); // Assurez-vous que ce fichier existe dans resources/views/bonlivraison/
    }
    public function edit($id)
    {
        $bonDeLivraison = BonLivraison::findOrFail($id);
        $clients = Client::all();
        return view('bonlivraison.edit', compact('bonDeLivraison', 'clients'));
    }


}

