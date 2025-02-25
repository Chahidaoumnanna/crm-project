@extends('master')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 10px;">
        <div class="text-center mb-4">
            <h4 class="fw-bold">Créer un compte</h4>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Champ Nom -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nom</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                           placeholder="Votre nom" value="{{ old('name') }}" required>
                </div>
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Champ Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="Votre email" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Champ Mot de passe -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Votre mot de passe" required>
                    <span class="input-group-text toggle-password" onclick="togglePassword()">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
                @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Champ Confirmation du mot de passe -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-semibold">Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-check-lg"></i></span>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                           placeholder="Confirmez votre mot de passe" required>
                </div>
                @error('password_confirmation')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bouton S'inscrire -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-person-plus"></i> S'inscrire
                </button>
            </div>
        </form>

        <!-- Lien vers la connexion -->
        <div class="text-center mt-3">
            <small>Déjà inscrit ? <a href="{{ route('login') }}" class="text-primary fw-bold">Se connecter</a></small>
        </div>
    </div>
</div>

<!-- Script pour afficher/masquer le mot de passe -->
<script>
    function togglePassword() {
        let passwordField = document.getElementById('password');
        let icon = document.querySelector('.toggle-password i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>

@endsection
