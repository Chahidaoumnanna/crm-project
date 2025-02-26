<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Livraison</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .container { width: 100%; padding: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<div class="container">
    <h2>Bon de Livraison - {{ $bonLivraison->ref }}</h2>
    <p><strong>Date :</strong> {{ $bonLivraison->docAt }}</p>
    <p><strong>Client :</strong> {{ $client->name }}</p>

    <table>
        <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->produit->nom }}</td>
                <td>{{ $item->qte }}</td>
                <td>{{ number_format($item->prixUnitaire, 2) }} €</td>
                <td>{{ number_format($item->total, 2) }} €</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p><strong>Total :</strong> {{ number_format($bonLivraison->totale, 2) }} €</p>
</div>
</body>
</html>
