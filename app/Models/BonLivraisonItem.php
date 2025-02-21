<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraisonItem extends Model
{
    use HasFactory;

    protected $fillable = ['IdProduit', 'IdBonLivraison', 'qte', 'prixUnitaire'];

    public function produits()
    {
        return $this->belongsTo(Produit::class, 'IdProduit');
    }
    public function bonLivraison()
    {
        return $this->belongsTo(BonLivraison::class, 'IdBonLivraison');
        }
}
