<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paiement extends Model
{
    use HasFactory  ,SoftDeletes;

    protected $fillable =
        [
            'idBonDeLivraison',
            'echeanceAt',
            'montant',
            'mode'
        ];

    public function bonLivraison()
    {
        return $this->belongsTo(BonLivraison::class, 'idBonDeLivraison');
    }
}
//
