<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Votacion>
 */
class VotacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $candidato = Candidato::inRandomOrder()->first(); // Obtiene un partido al azar
        // $zona = Estado::inRandomOrder()->first();
        return [
            //     'titulo' => $this->faker->sentence,
            //     'tipo' => $this->faker->randomElement(['Presidencial', 'Diputación', 'Senaduría']),
            //     'alcance' => $this->faker->randomElement(['Federal', 'Estatal']),
            //     'zona' => $zona,
            //     'numero_votos' => $this->faker->numberBetween(100, 1000),
            //     'numero_votos' => $this->faker->numberBetween(10, Votacion::max('numero_votos')),
        ];
    }
}
