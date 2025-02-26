@extends('base')

@section('title', 'Clients')

@section('bodyTitle', 'Clients')

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
                <a href="{{ route('clients.create') }}" class="btn btn-info">
                    <i class="bi bi-person-plus"></i> Ajouter un client
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <!-- Formulaire de recherche -->
            <div class="p-3 bg-light">
                <form id="searchForm" class="form-inline">
                    <div class="input-group">
                        <input type="text" id="clientSearchInput" class="form-control" placeholder="Rechercher par nom, code ou téléphone..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" onclick="filterClients()">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <table class="table align-items-center mb-0">
                <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nom</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Téléphone</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Adresse</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                </tr>
                </thead>
                <tbody id="clientsTableBody">
                @foreach($clients as $client)
                    <tr class="align-middle">
                        <td>{{ $client->code }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->address }}</td>
                        <td>{{ $client->type }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination personnalisée -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        <li class="page-item {{ $clients->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $clients->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>
                        @foreach ($clients->getUrlRange(1, $clients->lastPage()) as $page => $url)
                            <li class="page-item {{ $clients->currentPage() === $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li class="page-item {{ $clients->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $clients->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script>
        let timeoutId;

        document.getElementById('clientSearchInput').addEventListener('input', function () {
            clearTimeout(timeoutId); // Annule le délai précédent
            timeoutId = setTimeout(filterClients, 300); // Attend 300 ms avant de lancer la recherche
        });

        function filterClients() {
            const searchInput = document.getElementById('clientSearchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#clientsTableBody tr');

            rows.forEach(row => {
                const clientCode = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const clientName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const clientPhone = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

                const matches = clientCode.includes(searchInput) || clientName.includes(searchInput) || clientPhone.includes(searchInput);

                row.style.display = matches ? '' : 'none';
            });
        }
    </script>
@endsection
