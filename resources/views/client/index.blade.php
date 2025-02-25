@extends('base')

@section('title','Clients')

@section('bodyTitle','Clients')

@section('body')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Clients</h3>
            <div class="card-tools">
                <a href="{{ route('clients.create') }}" class="btn btn-info">Add Client</a>
            </div>
             <div class="card-body">
            <form action="{{ route('clients.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Recherche par nom ou code" value="{{ request('search') }}">
                    <div class="input-group-append w-25 ">
                        <button class="btn btn-outline-ligth" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>

        </div>
        <table class="table align-items-center mb-0">
        <thead>
                <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nom</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Téléphone</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Addresse</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr class="align-middle">

                        <td>{{ $client->code }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->address }}</td>
                        <td>{{ $client->type }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- Inclure Font Awesome (si ce n'est pas déjà fait) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Pagination personnalisée -->
<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm">
            <!-- Bouton "Précédent" -->
            <li class="page-item {{ $clients->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $clients->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                </a>
            </li>

            <!-- Liens des pages -->
            @foreach ($clients->getUrlRange(1, $clients->lastPage()) as $page => $url)
                <li class="page-item {{ $clients->currentPage() === $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <!-- Bouton "Suivant" -->
            <li class="page-item {{ $clients->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $clients->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                </a>
            </li>
        </ul>
    </nav>
</div>
</div>s
        </div>
    </div>

      @endsection
