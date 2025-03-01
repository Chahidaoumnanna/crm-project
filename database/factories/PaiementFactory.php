<?php

namespace Database\Factories;

use App\Models\Paiement;
use App\Models\BonLivraison;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaiementFactory extends Factory
{
    protected $model = Paiement::class;

    public function definition()
    {
        return [
            'idBonDeLivraison' => BonLivraison::factory(), // Génère un bon de livraison aléatoire
            'echeanceAt' => $this->faker->dateTimeBetween('-1 year', '+6 months'), // Entre l'année passée et dans 6 mois
            'montant' => $this->faker->randomFloat(2, 50, 5000), // Montant entre 50 et 5000
            'mode' => $this->faker->randomElement(['Espèces', 'Carte bancaire', 'Virement', 'Chèque']),
            ];
        }
}
//
