<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Filtrer les clients en fonction de la recherche avec pagination
        $clients = Client::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%');
        })->paginate(10); // Utilisation correcte de paginate()

        // Passer les clients filtrés à la vue
        return view('client.index', [
            'clients' => $clients
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $validatedData = $request->validated();


        $client = Client::create($validatedData);

        return redirect()->route('clients.index')->with('success', 'Client créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Client $client)
    {
        if ($request->wantsJson()) {
            return response()->json($client);
        }

        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Récupère le client à modifier
        $client = Client::find($id);

        // Si le client n'existe pas, redirige avec un message d'erreur
        if (!$client) {
            return redirect()->route('clients.index')->with('error', 'Client non trouvé.');
        }

        // Retourne la vue du formulaire de modification avec les données du client
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        // Met à jour le client avec les données validées
        $client->update($request->validated());

        // Redirige vers la liste des clients avec un message de succès
        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès !');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Client $client)
    {
        $client->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Client deleted successfully']);
        }

        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès !');
    }


    public function apiClients(Request $request){
        $search = $request->get('search');
        $clients = Client::all();
        if ($search) {
            $clients = Client::where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')->get();

            ;
        }
        return response()->json($clients);
    }
    public function apiCreateClient(Request $request) {
        // Validation des données d'entrée
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:clients',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
        ]);


        // Création d'un nouveau client
        $client = Client::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'code' => $validatedData['code'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'type' => $validatedData['type'],
        ]);

        // Retourner la réponse avec le client créé
        return response()->json($client, 201);

        return response()->json($client, 201);
    }
}
