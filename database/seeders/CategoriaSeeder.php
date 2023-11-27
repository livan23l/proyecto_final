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
            "Política",
            "Ciencia",
            "Tecnología",
            "Deportes",
            "Entretenimiento",
            "Economía",
            "Salud",
            "Medio Ambiente",
            "Cultura",
            "Internacional",
            "Educación",
            "Investigación",
            "Opinión",
            "Tecnología",
            "Innovación",
            "Arte y Diseño",
            "Viajes",
            "Gastronomía",
            "Moda",
            "Sociedad",
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'nombre' => $categoria,
            ]);
        }
    }
}
