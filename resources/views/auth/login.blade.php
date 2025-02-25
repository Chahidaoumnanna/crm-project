@extends('master')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 10px;">
        <div class="text-center mb-4">
            <h4 class="fw-bold">Connexion</h4>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
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

            <!-- Bouton Se connecter -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary"> 
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </button>
            </div>
        </form>

        <!-- Lien d'inscription -->
        <div class="text-center mt-3">
            <small>Pas encore inscrit ? <a href="{{ route('register') }}" class="text-primary fw-bold">Créer un compte</a></small>
        </div>
    </div>
</div>

<!-- Inclure Bootstrap & FontAwesome -->
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush
@endsection
