<?php

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

        // Récupère tous les produits triés par date de création (du plus récent au plus ancien)
        $produits = Produit::query()
            ->when($search, function ($query, $search) {
                // Filtre les produits par nom si un terme de recherche est fourni
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Vérifie si la requête attend une réponse JSON (par exemple, pour une API)
        if ($request->wantsJson()) {
            return response()->json($produits);
        }

        // Retourne la vue pour une application web traditionnelle
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
     * Afficher un produit spécifique.
     */
    public function show($id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        return response()->json($produit);
    }

    /**
     * Mettre à jour un produit existant.
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

    /**
     * Supprimer un produit.
     */
    /**
     * Supprimer un produit.
     */
    /**
     * Supprimer un produit.
     */
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
}
