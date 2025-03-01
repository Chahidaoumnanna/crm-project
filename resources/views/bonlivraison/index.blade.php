@extends('base')
@section('title', 'Bon de Livraison')
@section('bodyTitle', 'Bon de livraison')

@section('body')
    <a href="{{ route('bonlivraison.create') }}" class="btn btn-primary">
        <i class="bi bi-cart-plus"></i> Ajouter un Bon de Livraison
    </a>
    @if($bonlivraison->isEmpty())
        <div class="alert alert-info m-3">
            Aucun bon de Livraison trouvé.
        </div>
    @else
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>totale</th>
            <th>docAt</th>

        </tr>
        </thead>
        <tbody>
        @foreach($bonlivraison as $bonDeLivraison)
            <tr>
                <td>{{ $bonDeLivraison->id }}</td>
                <td>{{ $bonDeLivraison->client->name }}</td>
                <td>{{ $bonDeLivraison->totale }}</td>
                <td>{{ $bonDeLivraison-> docAt }}</td>
            </tr>

    @endforeach
    @endif

@endsection



