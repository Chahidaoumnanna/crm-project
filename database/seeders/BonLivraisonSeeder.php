<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BonLivraison;
use App\Models\Client;

class BonLivraisonSeeder extends Seeder
{
    public function run()
    {
        // Vérifier qu'il y a des clients avant d'ajouter des bons de livraison
        if (Client::count() == 0) {
            \App\Models\Client::factory(10)->create();
        }

        BonLivraison::factory(20)->create();
    }
}
