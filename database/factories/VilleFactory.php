<?php

namespace Database\Factories;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;

class VilleFactory extends Factory
{
    protected $model = Ville::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->city,
        ];
    }
}
// use Database\Factories\EtudiantFactory;
// use Database\Factories\VilleFactory;

// EtudiantFactory::new()->times(100)->create();
// VilleFactory::new()->times(15)->create();
