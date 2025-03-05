{{--@extends('base')--}}
{{--@section('title', 'Bon de Livraison')--}}
{{--@section('bodyTitle', 'Bon de livraison')--}}

{{--@section('body')--}}
{{--    <a href="{{ route('bonlivraison.create') }}" class="btn btn-primary">--}}
{{--        <i class="bi bi-cart-plus"></i> Ajouter un Bon de Livraison--}}
{{--    </a>--}}
{{--    @if($bonlivraison->isEmpty())--}}
{{--        <div class="alert alert-info m-3">--}}
{{--            Aucun bon de Livraison trouvé.--}}
{{--        </div>--}}
{{--    @else--}}
{{--    <table class="table table-striped">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>ID</th>--}}
{{--            <th>Client</th>--}}
{{--            <th>totale</th>--}}
{{--            <th>docAt</th>--}}

{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($bonlivraison as $bonDeLivraison)--}}
{{--            <tr>--}}
{{--                <td>{{ $bonDeLivraison->id }}</td>--}}
{{--                <td>{{ $bonDeLivraison->client->name }}</td>--}}
{{--                <td>{{ $bonDeLivraison->totale }}</td>--}}
{{--                <td>{{ $bonDeLivraison-> docAt }}</td>--}}
{{--            </tr>--}}

{{--    @endforeach--}}
{{--    @endif--}}

{{--@endsection--}}

@extends('base')
@section('title', 'Bon de Livraison')
@section('bodyTitle', '')
@section('body')
    <a href="{{ route('bonlivraison.create') }}"
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
        <i class="bi bi-cart-plus" style="transition: transform 0.3s;"
           onmouseover="this.style.transform='rotate(15deg)';"
           onmouseout="this.style.transform='rotate(0deg)';"></i>
        Nouvelle vente
    </a> </br></br>
    <div class="card-body p-0">
        <div class="p-3 bg-light">
            <form id="searchForm" class="form-inline">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par ID..." onkeyup="searchBon()">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if($bonlivraison->isEmpty())
            <div class="alert alert-info m-3">Aucun bon de Livraison trouvé.</div>
        @else
            <table class="table table-striped" id="bonTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Totale</th>
                    <th>Date</th>
                    <th>Paiement</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bonlivraison as $index => $bonDeLivraison)
                    <tr style="background-color: {{ $index % 2 == 0 ? '#FFFFFF' : '#88bde4' }};"
                        onmouseover="this.style.backgroundColor='#d6e4f2';"
                        onmouseout="this.style.backgroundColor='{{ $index % 2 == 0 ? '#FFFFFF' : '#88bde4' }}';"
                        onclick="selectRow(this)">
                        <td>{{ $bonDeLivraison->id }}</td>
                        <td>{{ $bonDeLivraison->client->name }}</td>
                        <td>{{ $bonDeLivraison->totale }}</td>
                        <td>{{ $bonDeLivraison->docAt }}</td>
                        <td>
                            @if($bonDeLivraison->paiements->isEmpty())
                                <span style="color: red;">Aucun paiement</span>
                            @else
                                @foreach($bonDeLivraison->paiements as $paiement)
                                    <div>
                                        Crédit : {{ $paiement->montant }} | Échéance : {{ $paiement->echeanceAt }}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td class="action-buttons" style="display: none;">
                            <a href="{{ route('bonlivraison.edit', $bonDeLivraison->id) }}"
                               style="background-color: #003366 ; color: white" class="btn btn-warning btn-sm" title="Modifier">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('bonlivraison.destroy', $bonDeLivraison->id) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce bon?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('ticket.index') }}" style="background-color: #88bde4" class="btn btn-primary btn-sm" title="Ticket">
                                <i class="bi bi-receipt"></i>
                            </a>
                            <button class="btn btn-secondary btn-sm move-up" onclick="moveRow(this, 'up')">↑</button>
                            <button class="btn btn-secondary btn-sm move-down" onclick="moveRow(this, 'down')">↓</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <script>
                function searchBon() {
                    let input = document.getElementById("searchInput").value.toLowerCase();
                    let rows = document.querySelectorAll("#bonTable tbody tr");
                    rows.forEach(row => {
                        let id = row.cells[0].textContent.toLowerCase();
                        row.style.display = id.includes(input) ? "" : "none";
                    });
                }

                function moveRow(button, direction) {
                    let row = button.closest("tr");
                    if (direction === "up" && row.previousElementSibling) {
                        row.parentNode.insertBefore(row, row.previousElementSibling);
                    } else if (direction === "down" && row.nextElementSibling) {
                        row.parentNode.insertBefore(row.nextElementSibling, row);
                    }
                }

                function selectRow(row) {
                    document.querySelectorAll("tr").forEach(tr => tr.classList.remove("selected"));
                    row.classList.add("selected");

                    document.querySelectorAll(".action-buttons").forEach(el => el.style.display = "none");
                    row.querySelector(".action-buttons").style.display = "block";
                }
            </script>
    @endif
@endsection
