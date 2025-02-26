@extends('base')

@section('title', 'Modifier un produit')

@section('bodyTitle', 'Modifier un produit')

@section('body')
    <div class="container mt-5">
        <a href="{{ route('produits.index') }}" class="btn btn-secondary mb-3">Annuler</a>

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
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Code</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" id="code" name="code" value="{{ $produit->code }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nom</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $produit->name }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Code-barres</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" id="codeBar" name="codeBar" value="{{ $produit->codeBar }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Prix de revient</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="number" step="0.01" class="form-control" id="prixRevient" name="prixRevient" value="{{ $produit->prixRevient }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Prix de vente</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="number" step="0.01" class="form-control" id="prixVente" name="prixVente" value="{{ $produit->prixVente }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">TVA (%)</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="number" step="0.01" class="form-control" id="tva" name="tva" value="{{ $produit->tva }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Remise (%)</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="number" step="0.01" class="form-control" id="remise" name="remise" value="{{ $produit->remise }}" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Enregistrer</button>
        </form>
    </div>
@endsection
