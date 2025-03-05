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
                <i class="bi bi-person-plus style="transition: transform 0.3s;"
                onmouseover="this.style.transform='rotate(15deg)';"
                onmouseout="this.style.transform='rotate(0deg)';"></i>
                Ajouter un client
            </a>
        </div>


        <div class="card-body p-0">
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
                    <th>Code</th>
                    <th>Nom</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Téléphone</th>
                    <th class="text-center">Adresse</th>
                    <th class="text-center">Type</th>
                    <th class="text-center"></th>
                </tr>
                </thead>
                <tbody id="clientsTableBody">
                @foreach($clients as $client)
                    <tr class="align-middle client-row">
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
        </div>
    </div>

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
