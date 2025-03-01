@extends('base')

@section('title', 'Tickets')

@section('bodyTitle', 'Tickets')

@section('body')



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


<div class="ticket">
    <div class="header">Novicore</div>
    <p>Hay Salam<br>Tél: 0707023780</p>
    <hr>
    <div class="details">
        <p><strong>N° Avoir :</strong> 44</p>
        <p><strong>Date :</strong> 2025-02-28</p>
        <p><strong>Client :</strong> Johari</p>
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
            <tr>
                <td>Chocolete</td>
                <td>4</td>
                <td>141 DH</td>
            </tr>
        </tbody>
    </table>

    <hr>
    <p class="total">Total : 142 DH</p>
    <p><strong>Espèce :</strong> 142 DH</p>

    <div class="footer">
        <p>Merci pour votre visite et à bientôt.</p>
    </div>

    <button class="print-btn btn btn-outline-primary" onclick="window.print()">🖨️ Imprimer</button>
</div>



@endsection
