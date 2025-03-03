@extends('base')

@section('title', 'Créer un client')

@section('bodyTitle', 'Créer un client')

@section('body')
    <div class="container mt-5">
        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left"></i> Annuler
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
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-lg p-4">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nom</label>
                        <input type="text" class="form-control rounded-3" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Code</label>
                        <input type="text" class="form-control rounded-3" name="code" value="{{ old('code') }}" required>
                        @error('code')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control rounded-3" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Téléphone</label>
                        <input type="text" class="form-control rounded-3" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Adresse</label>
                        <input type="text" class="form-control rounded-3" name="address" value="{{ old('address') }}" required>
                        @error('address')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Type</label>
                        <select class="form-select rounded-3" name="type" required>
                            <option value="">Sélectionner un type</option>
                            <option value="individual" {{ old('type') == 'individual' ? 'selected' : '' }}>Individu</option>
                            <option value="company" {{ old('type') == 'company' ? 'selected' : '' }}>Entreprise</option>
                            <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('type')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary btn-lg px-4 rounded-3 shadow-sm">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
