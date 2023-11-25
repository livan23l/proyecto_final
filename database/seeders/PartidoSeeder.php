<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('partidos')->insert([
            ['abreviacion' => 'MC', 'nombre' => 'Movimiento Ciudadano'],
            ['abreviacion' => 'MORENA', 'nombre' => 'Movimiento de Regeneración Nacional'],
            ['abreviacion' => 'PAN', 'nombre' => 'Partido Acción Nacional'],
            ['abreviacion' => 'PRD', 'nombre' => 'Partido Revolucionario Democrático'],
            ['abreviacion' => 'PRI', 'nombre' => 'Partido Revolucionario Institucional'],
            ['abreviacion' => 'PT', 'nombre' => 'Partido del Trabajo'],
            ['abreviacion' => 'PVEM', 'nombre' => 'Partido Verde Ecologista de México'],
        ]);
    }
}
