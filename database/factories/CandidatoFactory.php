<?php

namespace Database\Factories;

use App\Models\Partido;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidato>
 */
class CandidatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $partido = Partido::inRandomOrder()->first(); // Obtiene un partido al azar
        return [
            "nombre" => $this->faker->words(3, true),
            "f_nac" => fake()->dateTimeBetween('-100 years', '-18 years')->format('Y-m-d'),  // Tendrá entre 18 y 100 años.
            "partido" => $partido->abreviacion,
            "descripcion" => fake()->sentence(),
        ];
    }
}
