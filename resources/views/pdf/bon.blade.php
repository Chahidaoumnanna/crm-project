<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border="2">
    <tr >
        <td><b>BON DE LIVRAISON N :3333</b></td>
    </tr>
    <tr>
        <td>client: {{$bon->client->name}}</td>
    </tr>
</table>
<table border="2">
    <thead>
    <th>#</th>
    <th>Des</th>
    <th>qte</th>
    <th>P.U</th>
    <th>Totale</th>
    </thead>
    <tbody>
    @foreach($bon->items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td> <!-- Assure-toi d'afficher un champ correct -->
            <td>{{ $item->qte }}</td>
            <td>{{ $item->prixUnitaire }}</td>
            <td>{{ $item->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<h1>detaile des paiement</h1>
<table>
    <thead>
    <tr>
        <th>Montant</th>
        <th>mode</th>
        <th>echeance</th>
    </tr>

    </thead>
    <tbody>
    @forelse($bon->paiements as $paiement)
        <tr>
            <td>{{ $paiement->montant }}</td>
            <td>{{ $paiement->mode }}</td>
            <td>{{ $paiement->echeanceAt }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3">Aucun paiement enregistré.</td>
        </tr>
    @endforelse
    </tbody>
</table>
</body>
</html>

