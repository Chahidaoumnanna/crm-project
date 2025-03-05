<?php
//
//namespace App\Http\Controllers\Api;
//
//use App\Http\Requests\StoreProduitRequest;
//use App\Http\Requests\UpdateProduitRequest;
//use App\Models\Produit;
//use Illuminate\Http\Request;
//
//class ProduitController extends Controller
//{
//
//    public function index(Request $request)
//    {
//        // Récupère le terme de recherche depuis la requête
//        $search = $request->query('search');
//
//        // Récupère les produits avec pagination
//        $produits = Produit::query()
//            ->when($search, function ($query, $search) {
//                return $query->where('name', 'like', '%' . $search . '%');
//            })
//            ->orderBy('created_at', 'desc')
//            ->paginate(10); // Paginer avec 10 produits par page
//
//        // Vérifie si la requête attend une réponse JSON
//        if ($request->wantsJson()) {
//            return response()->json($produits);
//        }
//
//        // Retourne la vue avec la pagination
//        return view('produits.index', compact('produits'));
//    }
//
//
//    public function store(StoreProduitRequest $request)
//    {
//        // Validation des données entrantes est gérée par StoreProduitRequest
//        $produit = Produit::create($request->validated());
//
//        // Redirection vers la liste des produits avec un message de succès
//        return redirect()->route('produits.index');
//    }
//    /**
//     * Afficher le formulaire de création d'un produit.
//     */
//    public function create()
//    {
//        return view('produits.create'); // Retourne la vue du formulaire d'ajout
//    }
//
//    /**
//     * Afficher un produit spécifique.
//     */
//    public function show($id)
//    {
//        $produit = Produit::find($id);
//
//        if (!$produit) {
//            return response()->json(['message' => 'Produit non trouvé'], 404);
//        }
//
//        return response()->json($produit);
//    }
//
//    /**
//     * Mettre à jour un produit existant.
//     */
//    /**
//     * Mettre à jour un produit existant.
//     */
//    public function update(UpdateProduitRequest $request, $id)
//    {
//        // Récupère le produit à modifier
//        $produit = Produit::find($id);
//
//        // Si le produit n'existe pas, redirige avec un message d'erreur
//        if (!$produit) {
//            return redirect()->route('produits.index')->with('error', 'Produit non trouvé.');
//        }
//
//        // Met à jour le produit avec les données validées
//        $produit->update($request->validated());
//
//        // Redirige vers la liste des produits avec un message de succès
//        return redirect()->route('produits.index');
//    }
//    public function edit($id)
//    {
//        // Récupère le produit à modifier
//        $produit = Produit::find($id);
//
//        // Si le produit n'existe pas, redirige avec un message d'erreur
//        if (!$produit) {
//            return redirect()->route('produits.index')->with('error', 'Produit non trouvé.');
//        }
//
//        // Retourne la vue du formulaire de modification avec les données du produit
//        return view('produits.edit', compact('produit'));
//    }
//
//    /**
//     * Supprimer un produit.
//     */
//    /**
//     * Supprimer un produit.
//     */
//    /**
//     * Supprimer un produit.
//     */
//    public function destroy($id)
//    {
//        // Récupère le produit à supprimer
//        $produit = Produit::find($id);
//
//        // Si le produit existe, le supprime
//        if ($produit) {
//            $produit->delete();
//        }
//
//        // Redirige vers la liste des produits sans message
//        return redirect()->route('produits.index');
//    }
//    public function apiProduits(Request $request){
//        $search = $request->get('search');
//        $produit = Produit::all();
//        if ($search) {
//            $produit = Produit::where('name', 'like', '%' . $search . '%')
//                ->orwhere('codeBar', 'like', '%' . $search . '%')
//                ->get();
//        }
//        return response()->json($produit);
//        }
//
//}


namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{

    public function index(Request $request)
    {
        // Récupère le terme de recherche depuis la requête
        $search = $request->query('search');

        // Récupère les produits avec pagination
        $produits = Produit::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Paginer avec 10 produits par page

        // Vérifie si la requête attend une réponse JSON
        if ($request->wantsJson()) {
            return response()->json($produits);
        }

        // Retourne la vue avec la pagination
        return view('produits.index', compact('produits'));
    }


    public function store(StoreProduitRequest $request)
    {
        // Validation des données entrantes est gérée par StoreProduitRequest
        $produit = Produit::create($request->validated());

        // Redirection vers la liste des produits avec un message de succès
        return redirect()->route('produits.index');
    }

    /**
     * Afficher le formulaire de création d'un produit.
     */
    public function create()
    {
        return view('produits.create'); // Retourne la vue du formulaire d'ajout
    }

    /**
     * Afficher un produit spécifique.
     */
    public function show($id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        return response()->json($produit);
    }

    /**
     * Mettre à jour un produit existant.
     */
    /**
     * Mettre à jour un produit existant.
     */
    public function update(UpdateProduitRequest $request, $id)
    {
        // Récupère le produit à modifier
        $produit = Produit::find($id);

        // Si le produit n'existe pas, redirige avec un message d'erreur
        if (!$produit) {
            return redirect()->route('produits.index')->with('error', 'Produit non trouvé.');
        }

        // Met à jour le produit avec les données validées
        $produit->update($request->validated());

        // Redirige vers la liste des produits avec un message de succès
        return redirect()->route('produits.index');
    }

    public function edit($id)
    {
        // Récupère le produit à modifier
        $produit = Produit::find($id);

        // Si le produit n'existe pas, redirige avec un message d'erreur
        if (!$produit) {
            return redirect()->route('produits.index')->with('error', 'Produit non trouvé.');
        }

        // Retourne la vue du formulaire de modification avec les données du produit
        return view('produits.edit', compact('produit'));
    }
    public function destroy($id)
    {
        // Récupère le produit à supprimer
        $produit = Produit::find($id);

        // Si le produit existe, le supprime
        if ($produit) {
            $produit->delete();
        }

        // Redirige vers la liste des produits sans message
        return redirect()->route('produits.index');
    }

    public function apiProduits(Request $request)
    {
        $search = $request->get('search');
        $produit = Produit::all();
        if ($search) {
            $produit = Produit::where('name', 'like', '%' . $search . '%')
                ->orwhere('codeBar', 'like', '%' . $search . '%')
                ->get();
        }
        return response()->json($produit);
    }

    /**
     * Créer un nouveau produit via API.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiStore(Request $request)
    {
        $validatedData = $request->all();
        $produits = Produit::create([
            'code' => $validatedData['code'],
            'name' => $validatedData['name'],
            'tva' => $validatedData['tva'],
            'remise' => $validatedData['remise'],
            'prixVente' => $validatedData['prixVente'],
            'prixRevient' => $validatedData['prixRevient'],
            'codeBar' => $validatedData['codeBar'],
        ]);

        return response()->json(['message' => 'Bon de livraison créé avec succès', 'data' => $produits], 201);
    }

};

