<?php
//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//
//use Illuminate\Database\Eloquent\Model;
//
//class BonLivraison extends Model
//{
//    use HasFactory;
//
//    protected $fillable = ['code', 'IdClient', 'docAt', 'totale'];
//
//    public function client()
//    {
//        return $this->belongsTo(Client::class, 'IdClient');
//
//    }
//    public function paiemaents()
//    {
//        return $this->hasMany(Paiement::class);
//    }
//    public function bonLivraisonItems()
//    {
//        return $this->hasMany(BonLivraisonItem::class);
//    }
//}.

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraison extends Model
{
    use HasFactory;

    protected $fillable = ['idClient', 'ref', 'docAt', 'totale'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'idClient'); // Relation vers le modèle Client
    }


    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'idBonDeLivraison');
    }



    public function bonLivraisonItems()
    {
        return $this->hasMany(BonLivraisonItem::class);
    }
    public function items()
    {
        return $this->hasMany(BonLivraisonItem::class, 'idBonDeLivraison');
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($bonLivraison) {
            $bonLivraison->totale = $bonLivraison->items()->sum('total');
        });
    }
    //
    public function recalculerTotal()
    {
        $this->totale = $this->items()->sum('total');
        $this->save();
    }

}

