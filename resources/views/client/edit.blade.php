@extends('base')

@section('title', 'Modifier un client')

@section('bodyTitle', 'Modifier un client')

@section('body')
    <div class="container mt-5">


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
            <div class="card-body ">
                <a href="{{ route('produits.index') }}" class="btn btn-danger sm mb-2">
                    <i class="bi-x "></i>
                </a>
            <form action="{{ route('clients.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Code</label>
                        <input type="text" class="form-control rounded-3" name="code" value="{{ $client->code }}" required>
                        @error('code')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nom</label>
                        <input type="text" class="form-control rounded-3" name="name" value="{{ $client->name }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control rounded-3" name="email" value="{{ $client->email }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Téléphone</label>
                        <input type="text" class="form-control rounded-3" name="phone" value="{{ $client->phone }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Adresse</label>
                        <input type="text" class="form-control rounded-3" name="address" value="{{ $client->address }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Type</label>
                        <select class="form-select rounded-3" name="type" required>
                            <option value="">Sélectionner un type</option>
                            <option value="individual" {{ $client->type === 'individual' ? 'selected' : '' }}>Individu</option>
                            <option value="company" {{ $client->type === 'company' ? 'selected' : '' }}>Entreprise</option>
                            <option value="other" {{ $client->type === 'other' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success ">
                    <i class="bi-save sm"></i> Enregistrer
                </button>
            </form>
        </div>
    </div>
@endsection
