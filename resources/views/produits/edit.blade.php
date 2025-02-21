@extends('base')

@section('title', 'Modifier un produit')

@section('bodyTitle', 'Modifier un produit')

@section('body')
    <div class="container mt-5">
        <h1>Modifier un produit</h1>
        <a href="{{ route('produits.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produits.update', $produit->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Utilise la méthode PUT pour la mise à jour -->
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ $produit->code }}" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $produit->name }}" required>
            </div>
            <div class="mb-3">
                <label for="codeBar" class="form-label">Code-barres</label>
                <input type="text" class="form-control" id="codeBar" name="codeBar" value="{{ $produit->codeBar }}">
            </div>
            <div class="mb-3">
                <label for="prixRevient" class="form-label">Prix de revient</label>
                <input type="number" step="0.01" class="form-control" id="prixRevient" name="prixRevient" value="{{ $produit->prixRevient }}" required>
            </div>
            <div class="mb-3">
                <label for="prixVente" class="form-label">Prix de vente</label>
                <input type="number" step="0.01" class="form-control" id="prixVente" name="prixVente" value="{{ $produit->prixVente }}" required>
            </div>
            <div class="mb-3">
                <label for="tva" class="form-label">TVA (%)</label>
                <input type="number" step="0.01" class="form-control" id="tva" name="tva" value="{{ $produit->tva }}" required>
            </div>
            <div class="mb-3">
                <label for="remise" class="form-label">Remise (%)</label>
                <input type="number" step="0.01" class="form-control" id="remise" name="remise" value="{{ $produit->remise }}" required>
            </div>
            <button type="submit" class="btn btn-success">Enregestrer</button>
        </form>
    </div>
@endsection
