<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .ticket { width: 300px; margin: auto; padding: 10px; border: 1px dashed black; }
        .header { font-size: 18px; font-weight: bold; }
        .details, .footer { font-size: 14px; margin-top: 10px; }
        .table { width: 100%; margin-top: 10px; border-collapse: collapse; }
        .table th, .table td { border-bottom: 1px dashed black; padding: 5px; text-align: left; }
        .total { font-weight: bold; }
        .print-btn { margin-top: 10px; }
    </style>
</head>
<body>

<div class="ticket">
    <div class="header">Novicore</div>
    <p>Hay Salam<br>Tél: 0707023780</p>
    <hr>
    <div class="details">
        <p><strong>N° Avoir :</strong> {{ $bonLivraison->ref }}</p>
        <p><strong>Date :</strong> {{ $bonLivraison->docAt }}</p>
        <p><strong>Client :</strong> {{ $client->name }}</p>
    </div>
    <hr>

    <table class="table">
        <thead>
        <tr>
            <th>Produit</th>
            <th>QTE</th>
            <th>Prix</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->produit->nom }}</td>
                <td>{{ $item->qte }}</td>
                <td>{{ number_format($item->prixUnitaire, 2) }} DH</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <hr>
    <p class="total">Total : {{ number_format($bonLivraison->totale, 2) }} DH</p>
    <p><strong>Espèce :</strong> {{ number_format($bonLivraison->totale, 2) }} DH</p>

    <div class="footer">
        <p>Merci pour votre visite et à bientôt.</p>
    </div>

    <button class="print-btn" onclick="window.print()">🖨️ Imprimer</button>
</div>

</body>
</html>
