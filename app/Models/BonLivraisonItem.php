<?php
//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//
//class BonLivraisonItem extends Model
//{
//    use HasFactory;
//
//    protected $fillable = ['IdProduit', 'IdBonLivraison', 'qte', 'prixUnitaire'];
//
//    public function produits()
//    {
//        return $this->belongsTo(Produit::class, 'IdProduit');
//    }
//    public function bonLivraison()
//    {
//        return $this->belongsTo(BonLivraison::class, 'IdBonLivraison');
//        }
//}


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraisonItem extends Model
{
    use HasFactory;

    protected $fillable = ['idProduit', 'idBonDeLivraison', 'qte', 'prixUnitaire' , 'total'];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduit');
    }

    public function bonLivraison()
    {
        return $this->belongsTo(BonLivraison::class, 'idBonDeLivraison');
    }
    // Ajouter dans BonLivraisonItem.php
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            $item->total = $item->qte * $item->prixUnitaire;
        });

        static::saved(function ($item) {
            $item->bonLivraison->recalculerTotal();
        });

        static::deleted(function ($item) {
            $item->bonLivraison->recalculerTotal();
        });
    }
//
}
