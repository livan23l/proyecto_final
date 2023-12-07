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
        $estado = Estado::inRandomOrder()->first();

        $titulo = $this->faker->sentence;
        $contenido = $this->faker->paragraph;
        $origen = $this->faker->randomElement(['Federal', 'Estatal']);
        $zona = $estado->nombre;
        $votos_tot = $this->faker->numberBetween(100, 1000);
        $categ_select = $this->faker->paragraph;

        return [
            'titulo' => $titulo,
            'contenido' => $contenido,
            'origen' => $origen,
            'zona' => $zona,
            'votos_tot' => $votos_tot,
            'categ_select' => $this->faker->paragraph,
        ];
    }
}
