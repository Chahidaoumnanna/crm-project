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
        return $this->belongsTo(Client::class, 'idClient');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function bonLivraisonItems()
    {
        return $this->hasMany(BonLivraisonItem::class);
    }
}
