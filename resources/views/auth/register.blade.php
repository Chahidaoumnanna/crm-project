@extends('master')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 10px;">
        <div class="text-center mb-4">
            <h4 class="fw-bold">Créer un compte</h4>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Champ Nom -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nom</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" required>
                </div>
            </div>

            <!-- Champ Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" required>
                </div>
            </div>

            <!-- Champ Mot de passe -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Votre mot de passe" required>
                </div>
            </div>

            <!-- Champ Confirmation du mot de passe -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-semibold">Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmez votre mot de passe" required>
                </div>
            </div>

            <!-- Bouton S'inscrire -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> S'inscrire
                </button>
            </div>
        </form>

        <!-- Lien vers la connexion -->
        <div class="text-center mt-3">
            <small>Déjà inscrit ? <a href="{{ route('login') }}" class="text-primary fw-bold">Se connecter</a></small>
        </div>
    </div>
</div>

<!-- Inclure Bootstrap & FontAwesome -->
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush
@endsection
