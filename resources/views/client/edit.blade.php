@extends('base')

@section('title', 'Modifier un client')

@section('bodyTitle', 'Modifier un client')

@section('body')
    <div class="container mt-5">
        <a href="{{ route('clients.index') }}" class="btn btn-secondary mb-3">Annuller</a>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3>
                <div class="input-group input-group-outline my-3">
                    <input type="text" class="form-control" id="code" name="code" value="{{ $client->code }}">
                    <label class="form-label">Code</label>
                    @error('code')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Nom</label>

                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>

                    <div class="input-group input-group-outline my-3">
                        <input type="email" class="form-control" id="email" name="email" value="{{  $client->email }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Téléphone</label>

                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{  $client->phone }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Adresse</label>

                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" id="address" name="address" value="{{ $client->address }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Type</label>

                    <div class="input-group input-group-outline my-3">
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Sélectionner un type</option>
                            <option value="individual" {{ $client->type === 'individual' ? 'selected' : '' }}>Individu</option>
                            <option value="company" {{  $client->type === 'company' ? 'selected' : '' }}>Entreprise</option>
                            <option value="other" {{  $client->type === 'other' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Enregestrer</button>
        </form>
    </div>
@endsection
