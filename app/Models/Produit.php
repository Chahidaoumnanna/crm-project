<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes; // Utilisation du trait SoftDeletes

    protected $fillable = [
        'code',
        'name',
        'codeBar',
        'prixRevient',
        'prixVente',
        'tva',
        'remise'
    ];

    public function bonlivraisonsItems()
    {
        return $this->hasMany(BonLivraisonItem::class, 'IdProduit');
    }
}
