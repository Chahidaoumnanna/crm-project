@extends('base')

@section('title', 'Modifier un produit')

@section('bodyTitle', 'Modifier un produit')

@section('body')
    <div class="container mt-5">
        <div class="card shadow-lg rounded-3">

            <div class="card-body ">
                <a href="{{ route('produits.index') }}" class="btn btn-danger sm mb-2">
                    <i class="bi-x "></i>
                </a>
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('produits.update', $produit->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="code" class="form-label fw-bold">Code</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control rounded-3" id="code" name="code" value="{{ $produit->code }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Nom</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control rounded-3" id="name" name="name" value="{{ $produit->name }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="codeBar" class="form-label fw-bold">Code-barres</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control rounded-3" id="codeBar" name="codeBar" value="{{ $produit->codeBar }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="prixRevient" class="form-label fw-bold">Prix de revient</label>
                            <div class="input-group input-group-outline">
                                <input type="number" step="0.01" class="form-control rounded-3" id="prixRevient" name="prixRevient" value="{{ $produit->prixRevient }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="prixVente" class="form-label fw-bold">Prix de vente</label>
                            <div class="input-group input-group-outline">
                                <input type="number" step="0.01" class="form-control rounded-3" id="prixVente" name="prixVente" value="{{ $produit->prixVente }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="tva" class="form-label fw-bold">TVA (%)</label>
                            <div class="input-group input-group-outline">
                                <input type="number" step="0.01" class="form-control rounded-3" id="tva" name="tva" value="{{ $produit->tva }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="remise" class="form-label fw-bold">Remise (%)</label>
                            <div class="input-group input-group-outline">
                                <input type="number" step="0.01" class="form-control rounded-3" id="remise" name="remise" value="{{ $produit->remise }}" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success ">
                        <i class="bi-save sm"></i> Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
