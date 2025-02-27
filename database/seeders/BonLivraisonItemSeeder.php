<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BonLivraisonItem;
use App\Models\BonLivraison;
use App\Models\Produit;

class BonLivraisonItemSeeder extends Seeder
{
    public function run()
    {
        // Vérifier qu'il y a des bons de livraison et des produits avant de créer les items
        if (BonLivraison::count() == 0) {
            \App\Models\BonLivraison::factory(10)->create();
        }

        if (Produit::count() == 0) {
            \App\Models\Produit::factory(20)->create();
        }

        BonLivraisonItem::factory(50)->create();
    }
}
