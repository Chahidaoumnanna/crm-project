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
        <a href="{{ route('produits.index') }}" class="btn btn-danger sm mb-2">
            <i class="bi-x "></i>
        </a>

        @if(session('success'))
            <script>
                toastr.success("{{ session('success') }}", "Succès", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 5000,
                });
            </script>
        @endif

        @if($errors->any())
            <div class="alert alert-danger rounded-3 shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-lg p-4">
            <form action="{{ route('produits.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Code</label>
                        <input type="text" class="form-control rounded-3" name="code" value="{{ old('code') }}" required>
                        @error('code')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nom</label>
                        <input type="text" class="form-control rounded-3" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Prix de revient</label>
                        <input type="number" step="0.01" class="form-control rounded-3" name="prixRevient" value="{{ old('prixRevient') }}" required>
                        @error('prixRevient')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Prix de vente</label>
                        <input type="number" step="0.01" class="form-control rounded-3" name="prixVente" value="{{ old('prixVente') }}" required>
                        @error('prixVente')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">TVA (%)</label>
                        <input type="number" step="0.01" class="form-control rounded-3" name="tva" value="{{ old('tva') }}" required>
                        @error('tva')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Remise (%)</label>
                        <input type="number" step="0.01" class="form-control rounded-3" name="remise" value="{{ old('remise') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Code-barres</label>
                        <input type="text" class="form-control rounded-3" name="codeBar" value="{{ old('codeBar') }}" autofocus>
                        @error('codeBar')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary btn-sm px-4 rounded-3 shadow-sm">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
