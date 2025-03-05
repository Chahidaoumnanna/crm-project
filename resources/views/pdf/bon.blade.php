
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Livraison</title>
</head>
<body style="font-family: Arial, sans-serif;">
<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid black; text-align: left;">
    <tr>
        <td style="padding: 10px; "><strong>BON DE LIVRAISON N° :</strong> {{ $bon->id }}</td>
        <td style="padding: 10px; text-align: right;"><strong>Client :</strong> {{ $bon->client->name }}</td>
    </tr>
    <tr>
        <td style="padding: 10px;"><strong>Date :</strong> {{ $bon->docAt }}</td>
        <td style="padding: 10px; text-align: right;"><strong>Nombre d'articles :</strong> {{ $bon->nombreItems() }}</td>
    </tr>
</table>
<table style="width: 100%; border-collapse: collapse; border: 1px solid black; text-align: center;">
    <thead style="background-color: #88bde4;">
    <tr>
        <th style="border: 2px solid black; padding: 10px;">#</th>
        <th style="border: 2px solid black; padding: 10px;">Produit</th>
        <th style="border: 2px solid black; padding: 10px;">Quantité</th>
        <th style="border: 2px solid black; padding: 10px;">Prix Unitaire</th>
        <th style="border: 2px solid black; padding: 10px;">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bon->items as $item)
        <tr>
            <td style="border: 2px solid black; padding: 10px;">{{ $item->id }}</td>
            <td style="border: 2px solid black; padding: 10px;">{{ $item->produit->name }}</td>
            <td style="border: 2px solid black; padding: 10px;">{{ $item->qte }}</td>
            <td style="border: 2px solid black; padding: 10px;">{{ $item->produit->prixVente }}</td>
            <td style="border: 2px solid black; padding: 10px;">{{ $item->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<table style="width: 35%; border-collapse: collapse; border: 2px solid black; margin-left: auto; margin-right: 0">
    <tr>
        <td style="text-align: center; padding: 10px;">Total : <span style="color: red">{{ $bon->totale }}</span></td>
    </tr>
</table>
<h2 style="margin-top: 20px;">Détails des Paiements</h2>

<table style="width: 100%; border-collapse: collapse; border: 1px solid black; text-align: center;">
    <thead style="background-color: #88bde4;">
    <tr>
        <th style="border: 2px solid black; padding: 10px;">Montant</th>
        <th style="border: 2px solid black; padding: 10px;">Mode de paiement</th>
        <th style="border: 2px solid black; padding: 10px;">Échéance</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bon->paiements as $paiement)
        <tr>
            <td style="border: 2px solid black; padding: 10px;">{{ $paiement->montant }}</td>
            <td style="border: 2px solid black; padding: 10px;">{{ $paiement->mode }}</td>
            <td style="border: 2px solid black; padding: 10px;">{{ $paiement->echeanceAt }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
