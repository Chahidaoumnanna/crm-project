@extends('base')

@section('title', 'Clients')

@section('bodyTitle', 'Clients')

@section('body')
    <div class="card mb-4">
        <div class="card-header">
            <a href="{{ route('clients.create') }}"
               class="btn btn-sm btn-primary"
               style="background-color: #88bde4;
                      color: white;
                      padding: 10px 20px;
                      font-size: 16px;
                      border-radius: 5px;
                      border: none;
                      cursor: pointer;
                      display: inline-flex;
                      align-items: center;
                      justify-content: end;
                      gap: 8px;
                      transition: all 0.3s ease;
                      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);"
               onmouseover="this.style.backgroundColor = '#003366'; this.style.transform = 'scale(1.05)';"
               onmouseout="this.style.backgroundColor = '#88bde4'; this.style.transform = 'scale(1)';">
                <i class="bi bi-person-plus"></i> Ajouter un client
            </a>
        </div>

        <div class="card-body p-0">
            <!-- Formulaire de recherche -->
            <div class="p-3 bg-light">
                <form id="searchForm" class="form-inline">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par nom, code ou téléphone..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" onclick="filterClients()">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @if(session('success'))
                <div class="alert alert-success m-3">
                    {{ session('success') }}
                </div>
            @endif

            @if($clients->isEmpty())
                <div class="alert alert-info m-3">
                    Aucun client trouvé.
                </div>
            @else
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Type</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody id="clientsTableBody">
                    @foreach($clients as $client)
                        <tr class="client-row">
                            <td>{{ $client->code }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->address }}</td>
                            <td>{{ $client->type }}</td>
                            <td class="actions">
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
                                <a href="#" class="btn btn-sm btn-success">
                                    <i class="bi bi-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    <nav>
                        <ul class="pagination pagination-sm">
                            {{ $clients->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <!-- Script JavaScript pour la recherche dynamique -->
    <script>
        function filterClients() {
            const searchInput = document.getElementById('searchInput').value.trim().toLowerCase();
            const rows = document.querySelectorAll('#clientsTableBody tr');

            rows.forEach(row => {
                const clientName = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || "";
                const clientCode = row.querySelector('td:nth-child(1)')?.textContent.toLowerCase() || "";
                const clientPhone = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || "";

                const matches = clientName.includes(searchInput) || clientCode.includes(searchInput) || clientPhone.includes(searchInput);

                row.style.display = matches ? '' : 'none';
            });
        }

        // Ajoute un écouteur d'événements pour la recherche en temps réel
        document.getElementById('searchInput').addEventListener('input', filterClients);
    </script>

    <script>
        document.querySelectorAll('.client-row').forEach(row => {
            const actions = row.querySelector('.actions');
            actions.style.visibility = 'hidden';

            row.addEventListener('mouseenter', () => {
                actions.style.visibility = 'visible';
            });
            row.addEventListener('mouseleave', () => {
                actions.style.visibility = 'hidden';
            });
        });
    </script>
@endsection
