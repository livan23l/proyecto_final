<?php

namespace Database\Factories;

use App\Models\Candidato;
use App\Models\Estado;
use App\Models\Partido;
use App\Models\Votacion;
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
        $zona = Estado::inRandomOrder()->first();

        return [
            'nombre' => $this->faker->sentence,
            'tipo' => $this->faker->randomElement(['Presidencial', 'Diputación', 'Senaduría']),
            'alcance' => $this->faker->randomElement(['Federal', 'Estatal']),
            'zona' => $zona->nombre,
            'votos' => $this->faker->numberBetween(100, 1000),
            'votos_null' => $this->faker->numberBetween(10, Votacion::max('votos')),
            'descripcion' => $this->faker->paragraph,
        ];
    }
}
