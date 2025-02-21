<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    protected $model = Produit::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'code' => $this->faker->unique()->bothify('PROD#####'),
            'codeBar' => $this->faker->optional()->ean13(),
            'prixRevient' => $this->faker->randomFloat(2, 10, 1000),
            'prixVente' => $this->faker->randomFloat(2, 20, 2000),
            'tva' => $this->faker->randomFloat(2, 0, 20),
            'remise' => $this->faker->randomFloat(2, 0, 10),
            ];}
}
