@extends('base')

@section('title', 'Produits')

@section('bodyTitle', 'Produits')

@section('body')

        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('produits.create') }}"
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
                    Ajouter un produit                </a>
            </div>
        <div class="card-body p-0">
            <!-- Formulaire de recherche -->
            <div class="p-3 bg-light">
                <form id="searchForm" class="form-inline">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par nom, code ou code-barres..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" onclick="filterProducts()">
                                <i class="bi bi-search-heart"></i>
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

            @if($produits->isEmpty())
                <div class="alert alert-info m-3">
                    Aucun produit trouvé.
                </div>
            @else
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Code-barres</th>
                        <th>Prix de revient</th>
                        <th>Prix de vente</th>
                        <th>TVA</th>
                        <th>Remise</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="produitsTableBody">
                    @foreach($produits as $produit)
                        <tr>
                            <td>{{ $produit->id }}</td>
                            <td>{{ $produit->code }}</td>
                            <td>{{ $produit->name }}</td>
                            <td>{{ $produit->codeBar }}</td>
                            <td>{{ $produit->prixRevient }}</td>
                            <td>{{ $produit->prixVente }}</td>
                            <td>{{ $produit->tva }}</td>
                            <td>{{ $produit->remise }}</td>
                            <td>
                                <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i>
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
                            {{ $produits->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <!-- Script JavaScript pour la recherche dynamique par nom et code barre -->
    <script>
        function filterProducts() {
            const searchInput = document.getElementById('searchInput').value.trim().toLowerCase(); // Récupère la valeur de recherche
            const rows = document.querySelectorAll('#produitsTableBody tr'); // Récupère toutes les lignes du tableau

            rows.forEach(row => {
                const productName = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || ""; // Nom du produit
                const productCode = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || ""; // Code du produit
                const productCodeBar = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || ""; // Code-barres

                // Vérifie si l'un des champs correspond au texte recherché
                const matches = productName.includes(searchInput) || productCode.includes(searchInput) || productCodeBar.includes(searchInput);

                row.style.display = matches ? '' : 'none'; // Affiche ou masque la ligne
            });
        }

        // Ajoute un écouteur d'événements sur l'input pour la recherche en temps réel
        document.getElementById('searchInput').addEventListener('input', filterProducts);
    </script>

    <script>
        document.querySelectorAll('#produitsTableBody tr').forEach(row => {
            const actions = row.querySelector('td:last-child'); // Dernière colonne contenant les boutons

            // Masquer les actions par défaut
            actions.style.visibility = 'hidden';

            // Afficher au survol
            row.addEventListener('mouseenter', () => {
                actions.style.visibility = 'visible';
            });
            row.addEventListener('mouseleave', () => {
                actions.style.visibility = 'hidden';
            });
        });
    </script>
@endsection
