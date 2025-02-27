<?php

namespace Database\Factories;

use App\Models\BonLivraisonItem;
use App\Models\BonLivraison;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BonLivraisonItem>
 */
class BonLivraisonItemFactory extends Factory
{
    protected $model = BonLivraisonItem::class;

    public function definition()
    {
        return [
            'idBonDeLivraison' => BonLivraison::inRandomOrder()->first()->id ?? BonLivraison::factory(),
            'idProduit' => Produit::inRandomOrder()->first()->id ?? Produit::factory(),
            'qte' => $this->faker->numberBetween(1, 100),
            'prixUnitaire' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
