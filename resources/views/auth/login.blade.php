@extends('master')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 10px;">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Bienvenue sur le Dashboard</h1>
            <p class="account-subtitle">Besoin d'un compte ? <a href="{{ route('register') }}" class="text-primary fw-bold">S'inscrire</a></p>
        </div>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Champ Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
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
                <label for="password" class="form-label fw-semibold">Mot de passe <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control pass-input @error('password') is-invalid @enderror"
                           placeholder="Votre mot de passe" required>
                    <span class="input-group-text toggle-password" onclick="togglePassword()"><i class="bi bi-eye"></i></span>
                </div>
                @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Se souvenir de moi & mot de passe oublié -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>
                <a href="#" class="text-decoration-none text-primary">Mot de passe oublié ?</a>
            </div>

            <!-- Bouton Connexion -->
            <div class="d-grid">
                <button class="btn btn-primary" type="submit"><i class="bi bi-box-arrow-in-right"></i> Se connecter</button>
            </div>
        </form>

        <!-- Ou se connecter avec -->
        <div class="text-center my-3">
            <span class="text-muted">ou</span>
        </div>
        <div class="d-flex justify-content-center gap-3">
            <a href="#" class="btn btn-outline-danger"><i class="bi bi-google"></i></a>
            <a href="#" class="btn btn-outline-primary"><i class="bi bi-facebook"></i></a>
            <a href="#" class="btn btn-outline-info"><i class="bi bi-twitter"></i></a>
            <a href="#" class="btn btn-outline-secondary"><i class="bi bi-linkedin"></i></a>
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
