@extends('base')

@section('title', 'Modifier Bon de Livraison')

@section('body')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('bonlivraison.update', $bonDeLivraison->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="client_id" class="form-label">Client</label>
                    <select name="client_id" id="client_id" class="form-control" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $bonDeLivraison->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="totale" class="form-label">Montant Total</label>
                    <input type="number" name="totale" id="totale" class="form-control" value="{{ $bonDeLivraison->totale }}" required>
                </div>

                <div class="mb-3">
                    <label for="docAt" class="form-label">Date</label>
                    <input type="date" name="docAt" id="docAt" class="form-control" value="{{ $bonDeLivraison->docAt }}" required>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('bonlivraison.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
@endsection
