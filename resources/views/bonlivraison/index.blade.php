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
       class="btn btn-primary"
       style="background-color: #88bde4;
          color: white;
          padding: 10px 20px;
          font-size: 16px;
          border-radius: 5px;
          border: none;
          cursor: pointer;
          display: inline-flex;
          align-items: center;
          margin-left: 950px;
          gap: 8px;
          transition: all 0.3s ease;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);"
       onmouseover="this.style.backgroundColor = '#003366'; this.style.transform = 'scale(1.05)';"
       onmouseout="this.style.backgroundColor = '#88bde4'; this.style.transform = 'scale(1)';">
        <i class="bi bi-cart-plus" style="transition: transform 0.3s;"
           onmouseover="this.style.transform='rotate(15deg)';"
           onmouseout="this.style.transform='rotate(0deg)';"></i>
        Ajouter un Bon de Livraison
    </a> </br></br>

    @if($bonlivraison->isEmpty())
        <div class="alert alert-info m-3">Aucun bon de Livraison trouvé.</div>
    @else
        <table class="table table-striped">
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
                    onmouseout="this.style.backgroundColor='{{ $index % 2 == 0 ? '#FFFFFF' : '#88bde4' }}';">
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
                    <td style="display: none;" class="action-buttons">
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
                        <a href="{{ route('ticket.index') }}"  style="background-color: #88bde4" class="btn btn-primary btn-sm" title="Ticket">
                            <i class="bi bi-receipt"></i>
                        </a>

                        <!-- Flèches pour déplacer l'élément -->
                        <button class="btn btn-secondary btn-sm move-up" onclick="moveUp(this)">↑</button>
                        <button class="btn btn-secondary btn-sm move-down" onclick="moveDown(this)">↓</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <script>
            // Fonction pour déplacer l'élément vers le haut
            function moveUp(button) {
                const row = button.closest('tr');
                const previousRow = row.previousElementSibling;
                if (previousRow) {
                    row.parentNode.insertBefore(row, previousRow);
                }
            }

            // Fonction pour déplacer l'élément vers le bas
            function moveDown(button) {
                const row = button.closest('tr');
                const nextRow = row.nextElementSibling;
                if (nextRow) {
                    row.parentNode.insertBefore(nextRow, row);
                }
            }

            // Ajouter un gestionnaire d'événements pour chaque ligne du tableau
            const rows = document.querySelectorAll('tr');
            rows.forEach(row => {
                row.addEventListener('mouseover', () => {
                    const actions = row.querySelector('.action-buttons');
                    actions.style.display = 'inline-flex'; // Afficher les actions
                });
                row.addEventListener('mouseout', () => {
                    const actions = row.querySelector('.action-buttons');
                    actions.style.display = 'none'; // Masquer les actions
                });
            });
        </script>
    @endif
@endsection
on
