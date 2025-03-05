{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Document</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<table border="2">--}}
{{--    <tr >--}}
{{--        <td><b>BON DE LIVRAISON N :3333</b></td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td>client: {{$bon->client->name}}</td>--}}
{{--    </tr>--}}
{{--</table>--}}
{{--<table border="2">--}}
{{--    <thead>--}}
{{--    <th>#</th>--}}
{{--    <th>Des</th>--}}
{{--    <th>qte</th>--}}
{{--    <th>P.U</th>--}}
{{--    <th>Totale</th>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($bon->items as $item)--}}
{{--        <tr>--}}
{{--            <td>{{ $item->id }}</td>--}}
{{--            <td>{{ $item->name }}</td> <!-- Assure-toi d'afficher un champ correct -->--}}
{{--            <td>{{ $item->qte }}</td>--}}
{{--            <td>{{ $item->prixUnitaire }}</td>--}}
{{--            <td>{{ $item->total }}</td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}
{{--<h1>detaile des paiement</h1>--}}
{{--<table>--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>Montant</th>--}}
{{--        <th>mode</th>--}}
{{--        <th>echeance</th>--}}
{{--    </tr>--}}

{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @forelse($bon->paiements as $paiement)--}}
{{--        <tr>--}}
{{--            <td>{{ $paiement->montant }}</td>--}}
{{--            <td>{{ $paiement->mode }}</td>--}}
{{--            <td>{{ $paiement->echeanceAt }}</td>--}}
{{--        </tr>--}}
{{--    @empty--}}
{{--        <tr>--}}
{{--            <td colspan="3">Aucun paiement enregistré.</td>--}}
{{--        </tr>--}}
{{--    @endforelse--}}
{{--    </tbody>--}}
{{--</table>--}}
{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Livraison</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .header-table td {
            border: none;
            text-align: left;
        }
        .highlight {
            background-color: #dbead8;
            font-weight: bold;
        }
    </style>
</head>
<body>

<table class="header-table">
    <tr>
        <td><strong>BON DE LIVRAISON N° :</strong> {{ $bon->id }}</td>
        <td style="text-align: right;"><strong>{{ $bon->client->name }}</strong></td>
    </tr>
</table>

<table>
    <tr class="highlight">
        <td>Date</td>
        <td>Devis</td>
        <td>Nbr d’articles</td>
    </tr>
    <tr>
        <td>{{ $bon->date }}</td>
        <td>-</td>
        <td>{{ count($bon->items) }}</td>
    </tr>
</table>

<table>
    <tr class="highlight">
        <th>#</th>
        <th>Réf</th>
        <th>Désignation</th>
        <th>Qté</th>
        <th>P.U</th>
        <th>Total</th>
    </tr>
    @foreach($bon->items as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->ref }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->qte }}</td>
            <td>{{ number_format($item->prixUnitaire, 2, ',', ' ') }}</td>
            <td>{{ number_format($item->total, 2, ',', ' ') }}</td>
        </tr>
    @endforeach
</table>

<table>
    <tr>
        <td style="text-align: right; font-weight: bold;">Total :</td>
        <td style="text-align: right;">{{ number_format($bon->total, 2, ',', ' ') }}</td>
    </tr>
</table>

<table>
    <tr class="highlight">
        <th>Montant</th>
        <th>Mode</th>
        <th>Échéance</th>
    </tr>
    @foreach($bon->paiements as $paiement)
        <tr>
            <td>{{ number_format($paiement->montant, 2, ',', ' ') }}</td>
            <td>{{ $paiement->mode }}</td>
            <td>{{ $paiement->echeanceAt }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>
