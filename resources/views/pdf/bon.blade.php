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
</head>
<body style="font-family: Arial, sans-serif;">

<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 2px solid black;">
    <tr>
        <td style="padding: 10px; text-align: center; font-weight: bold; border-bottom: 2px solid black;">
            BON DE LIVRAISON N° : {{ $bon->id }}
        </td>
    </tr>
</table>

<table style="width: 100%; border-collapse: collapse; border: 2px solid black; margin-bottom: 20px;">
    <tr>
        <td style="padding: 10px; font-weight: bold;">Client :</td>
        <td style="padding: 10px;">{{ $bon->client->name }}</td>
    </tr>
</table>

<table style="width: 100%; border-collapse: collapse; border: 2px solid black; text-align: center;">
    <thead style="background-color: #e8f3dc;">
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
            <td style="border: 2px solid black; padding: 10px;">{{ $item->name }}</td>
            <td style="border: 2px solid black; padding: 10px;">{{ $item->qte }}</td>
            <td style="border: 2px solid black; padding: 10px;">{{ $item->prixUnitaire }}</td>
            <td style="border: 2px solid black; padding: 10px;">{{ $item->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table style="width: 100%; border-collapse: collapse; margin-top: 20px; border: 2px solid black;">
    <tr>
        <td style="text-align: right; font-weight: bold; padding: 10px;">Total :</td>
        <td style="text-align: right; padding: 10px;">{{ $bon->total }}</td>
    </tr>
</table>

<h2 style="margin-top: 20px;">Détails des Paiements</h2>

<table style="width: 100%; border-collapse: collapse; border: 2px solid black; text-align: center;">
    <thead style="background-color: #e8f3dc;">
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
