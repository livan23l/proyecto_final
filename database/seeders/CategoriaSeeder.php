<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            "Politica",
            "Ciencia",
            "Tecnologia",
            "Deportes",
            "Entretenimiento",
            "Economia",
            "Salud",
            "Ambiental",
            "Cultura",
            "Internacional",
            "Educacion",
            "Investigacion",
            "Opinion",
            "Innovacion",
            "Arte",
            "Viajes",
            "Gastronomia",
            "Moda",
            "Sociedad",
            "Cine",
            "Literatura",
            "Delincuencia",
            "Robo",
            "Secuestro",
            "Asesinato",
            "Homicidio",
            "Historia",
            "Comercio",
            "Animales",
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'nombre' => $categoria,
            ]);
        }
    }
}
