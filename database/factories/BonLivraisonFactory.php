<?php

namespace Database\Factories;

use App\Models\BonLivraison;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BonLivraison>
 */
class BonLivraisonFactory extends Factory
{
    protected $model = BonLivraison::class;

    public function definition()
    {
        return [
            'ref' => $this->faker->unique()->bothify('BL-####'),
            'idClient' => Client::inRandomOrder()->first()->id ?? Client::factory(),
            'docAt' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'totale' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}
//
