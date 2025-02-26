@extends('base')

@section('title', 'Produits')

@section('bodyTitle', 'Produits')

@section('body')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let barcodeInput = document.getElementById("codeBar");
            let form = document.querySelector("form");

            if (barcodeInput && form) {
                barcodeInput.focus();

                barcodeInput.addEventListener("keydown", function (event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        event.stopPropagation();
                        let barcode = barcodeInput.value.trim();
                        if (!barcode) {
                            alert("Le champ code-barres ne peut pas être vide.");
                        }
                    }
                });

                form.querySelectorAll("input:not(#codeBar)").forEach(input => {
                    input.addEventListener("keydown", function (event) {
                        if (event.key === "Enter") {
                            event.preventDefault();
                            event.stopPropagation();

                            let requiredFields = document.querySelectorAll("[required]");
                            let emptyFields = Array.from(requiredFields).some(input => !input.value.trim());

                            if (!emptyFields) {
                                form.submit();
                            } else {
                                alert("Veuillez remplir tous les champs requis avant d'envoyer.");
                            }
                        }
                    });
                });
            } else {
                console.error("Le champ codeBar ou le formulaire n'a pas été trouvé dans le DOM.");
            }
        });
    </script>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Ajouter un produit</h1>
            <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Retour
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('produits.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Code</label>
                            <input type="text" class="form-control" id="code" name="code">
                            @error('code')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="prixRevient" class="form-label">Prix de revient</label>
                            <input type="number" step="0.01" class="form-control" id="prixRevient" name="prixRevient" required>
                            @error('prixRevient')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="prixVente" class="form-label">Prix de vente</label>
                            <input type="number" step="0.01" class="form-control" id="prixVente" name="prixVente" required>
                            @error('prixVente')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tva" class="form-label">TVA (%)</label>
                            <input type="number" step="0.01" class="form-control" id="tva" name="tva" required>
                            @error('tva')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="remise" class="form-label">Remise (%)</label>
                            <input type="number" step="0.01" class="form-control" id="remise" name="remise" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="codeBar" class="form-label">Code-barres</label>
                            <input type="text" class="form-control" id="codeBar" name="codeBar" autofocus>
                            @error('codeBar')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-cart-plus"></i> Ajouter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
