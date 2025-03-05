<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\BonLivraison;
//use App\Models\BonLivraisonItem;
//use Barryvdh\DomPDF\Facade\Pdf;
//use Illuminate\Http\Request;
//
//class PdfController
//{
////    public function print(int $id )
//
////        $pdf = Pdf::loadView('pdf.bon', ['bon' => BonLivraison::findOrFail($id) , 'items' => BonLivraisonItem::all()]);
////        return $pdf->stream();
//
//
//public function print(int $id)
//{
//    $bon = BonLivraison::with('items', 'client', 'paiements')->findOrFail($id);
////    dd($bon->paiements);
//    $pdf = Pdf::loadView('pdf.bon', compact('bon'));
//    return $pdf->stream();
//}
//
//}
// PdfController.php

namespace App\Http\Controllers;

use App\Models\BonLivraison;
use App\Models\BonLivraisonItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function print(int $id)
    {
        // Récupérer le bon de livraison avec ses items, client et paiements
        $bon = BonLivraison::with('items', 'client', 'paiements')->findOrFail($id);

        // Charger la vue pdf bon pour générer le PDF
        $pdf = Pdf::loadView('pdf.bon', compact('bon'));

        // Retourner le PDF
        return $pdf->stream(); // Cela permettra de l'afficher directement dans le navigateur
        }
}
