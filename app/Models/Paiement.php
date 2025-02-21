<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = ['IdBonLivraison','echeanceAt','montant', 'mode' ];

    public function bonLivraison()
    {
        return $this->belongsTo(BonLivraison::class, 'IdBonLivraison');
    }
}
