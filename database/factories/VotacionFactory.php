<?php

namespace Database\Factories;

use App\Models\Candidato;
use App\Models\Estado;
use App\Models\Votacion;
use App\Models\VotacionCandidato;
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
        $estado = Estado::inRandomOrder()->first();

        $nombre = $this->faker->sentence;
        $tipo = $this->faker->randomElement(['Presidencial', 'Diputación', 'Senaduría']);
        $alcance = $this->faker->randomElement(['Federal', 'Estatal']);
        $zona = ($alcance == "Federal") ? "México" : $estado;
        $votos = $this->faker->numberBetween(100, 1000);
        $votos_null = $this->faker->numberBetween(10, 50);
        $descripcion = $this->faker->paragraph;

        return [
            'nombre' => $nombre,
            'tipo' => $tipo,
            'alcance' => $alcance,
            'zona' => $zona,
            'votos' => $votos,
            'votos_null' => $votos_null,
            'descripcion' => $descripcion,
        ];
    }

    public function configure()  // Creación de los registros de candidatos.
    {
        return $this->afterCreating(  // Una vez la votación se haya almacenado en la BD.
            function (Votacion $votacion) {  // Recibimos la votación actual.
                $vot_rest = $votacion->votos - $votacion->votos_null;

                $candidatos = Candidato::inRandomOrder()->get();  // Todos los candidatos.
                $c_tot = $this->faker->numberBetween(2, 8);  // Seleccionamos el total de candidatos.
                $c = [];  // Arreglo que guardará los datos de cada candidato.

                // Ponemos los datos de todos los candidatos menos el último:
                $i = 0;
                for ($i; $i < $c_tot - 1; $i++) {
                    $c[$i] = [];  // Cada candidato almacenará dos valores
                    $c[$i]["candidato_id"] = $candidatos[$i]->id;
                    $c[$i]["votos"] = $this->faker->numberBetween(0, $vot_rest);
                    $vot_rest -= $c[$i]["votos"];  // Actualizamos los votos restantes.   
                }
                $c[$i] = [];  // Cada candidato almacenará dos valores
                $c[$i]["candidato_id"] = $candidatos[$i]->id;
                $c[$i]["votos"] = $vot_rest;

                // Guardamos a cada candidato con su cantidad de votos:
                for ($i = 0; $i < $c_tot; $i++) {
                    VotacionCandidato::create([
                        'votacion_id' => $votacion->id,
                        'candidato_id' => $c[$i]["candidato_id"],
                        'votos' => $c[$i]["votos"],
                    ]);
                }
            }
        );
    }
}
