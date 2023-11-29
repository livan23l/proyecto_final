<?php

namespace Database\Factories;

use App\Models\Estado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Noticia>
 */
class NoticiaFactory extends Factory
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
            'titulo' => $this->faker->sentence,
            'contenido' => $this->faker->paragraph,
            'origen' => $this->faker->randomElement(['Federal', 'Estatal']),
            'zona' => $zona->nombre,
            'votos_tot' => $this->faker->numberBetween(100, 1000),
            'categ_select' => $this->faker->paragraph,
        ];
    }
}
