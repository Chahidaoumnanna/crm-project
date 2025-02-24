<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->query('search');

    // Filtrer les clients en fonction de la recherche
    $clients = Client::when($search, function ($query, $search) {
        return $query->where('name', 'like', '%' . $search . '%')
                     ->orWhere('code', 'like', '%' . $search . '%');
    })->get(); // Utilisez `paginate(10)` si vous voulez ajouter la pagination
  
    $clients = Client::when($search, function ($query, $search) {
        return $query->where('name', 'like', '%' . $search . '%')
                     ->orWhere('code', 'like', '%' . $search . '%');
    })->paginate(10);
    // Passer les clients filtrés à la vue
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

        Client::create($validatedData);

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
