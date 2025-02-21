@extends('base')

@section('title', 'Produits')

@section('bodyTitle', 'Produits')

@section('body')
    <div class="container mt-5">
        <!-- Conteneur pour le bouton et les champs de recherche -->
        <div class="d-flex align-items-center justify-content-between mb-3">
            <!-- Bouton "Ajouter un produit" -->
            <a href="{{ route('produits.create') }}" class="btn btn-primary">Ajouter un produit</a>

            <!-- Formulaire de recherche -->
            <form id="searchForm" class="d-flex gap-2">
                <input type="text" id="searchName" class="form-control" placeholder="Rechercher par nom..." value="{{ request('searchName') }}">
                <input type="text" id="searchCode" class="form-control" placeholder="Rechercher par code..." value="{{ request('searchCode') }}">
                <input type="text" id="searchCodeBar" class="form-control" placeholder="Rechercher par code-barres..." value="{{ request('searchCodeBar') }}">
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($produits->isEmpty())
            <div class="alert alert-info">
                Aucun produit trouvé.
            </div>
        @else
            <table class="table table-bordered">
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
                    <th>Actions</th>
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
                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Script JavaScript pour la recherche dynamique -->
    <script>
        // Fonction pour filtrer les produits
        function filterProducts() {
            const searchName = document.getElementById('searchName').value.toLowerCase(); // Récupère le terme de recherche par nom
            const searchCode = document.getElementById('searchCode').value.toLowerCase(); // Récupère le terme de recherche par code
            const searchCodeBar = document.getElementById('searchCodeBar').value.toLowerCase(); // Récupère le terme de recherche par code-barres
            const rows = document.querySelectorAll('#produitsTableBody tr'); // Récupère toutes les lignes du tableau

            rows.forEach(row => {
                const productName = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // Récupère le nom du produit (3ème colonne)
                const productCode = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Récupère le code du produit (2ème colonne)
                const productCodeBar = row.querySelector('td:nth-child(4)').textContent.toLowerCase(); // Récupère le code-barres du produit (4ème colonne)

                // Vérifie si le produit correspond aux critères de recherche
                const matchesName = productName.includes(searchName);
                const matchesCode = productCode.includes(searchCode);
                const matchesCodeBar = productCodeBar.includes(searchCodeBar);

                // Affiche ou masque la ligne en fonction des critères de recherche
                if (matchesName && matchesCode && matchesCodeBar) {
                    row.style.display = ''; // Affiche la ligne si tous les critères sont remplis
                } else {
                    row.style.display = 'none'; // Masque la ligne sinon
                }
            });
        }

        // Écoute les changements dans les champs de recherche
        document.getElementById('searchName').addEventListener('input', filterProducts);
        document.getElementById('searchCode').addEventListener('input', filterProducts);
        document.getElementById('searchCodeBar').addEventListener('input', filterProducts);
    </script>
@endsection
